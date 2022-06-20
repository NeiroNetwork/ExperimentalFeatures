<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17\block;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;
use pocketmine\block\utils\AnyFacingTrait;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\block\utils\SupportType;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

abstract class BaseAmethystCluster extends Transparent{
	use AnyFacingTrait;

	protected function writeStateToMeta() : int{
		return BlockDataSerializer::writeFacing($this->facing);
	}

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->facing = BlockDataSerializer::readFacing($stateMeta);
	}

	public function __construct(BlockIdentifier $idInfo, string $name){
		parent::__construct($idInfo, $name, new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()));
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}

	protected function recalculateCollisionBoxes() : array{
		[$side1, $side2] = match($this->facing){
			Facing::UP, Facing::DOWN => [Axis::X, Axis::Z],
			Facing::NORTH, Facing::SOUTH => [Axis::Y, Axis::X],
			Facing::WEST, Facing::EAST => [Axis::Y, Axis::Z],
		};
		[$width, $height] = $this->getWidthHeight();
		return [AxisAlignedBB::one()
			->trim($this->facing, (16 - $height) / 16)
			->squash($side1, (16 - $width / 2) / 16)
			->squash($side2, (16 - $width / 2) / 16)
		];
	}

	/**
	 * Returns an array representing the width and height of the block in pixels.
	 */
	abstract function getWidthHeight() : array;

	public function getSupportType(int $facing) : SupportType{
		return SupportType::NONE();
	}

	public function isSolid() : bool{
		return false;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if(!$this->getSide(Facing::opposite($face))->isSolid()){
			return false;
		}

		$this->facing = $face;
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function onNearbyBlockChange() : void{
		if(!$this->getSide(Facing::opposite($this->facing))->isSolid()){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function getDropsForCompatibleTool(Item $item) : array{
		return [VanillaItems::amethyst_shard()->setCount(4)];
	}

	public function getDropsForIncompatibleTool(Item $item) : array{
		return [VanillaItems::amethyst_shard()->setCount(2)];
	}

	public function asItem() : Item{
		// FIXME: これが無いとアイテムにしようとしたときにメタがそのまま残ってしまう (本来の使い方ではないはず)
		return ItemFactory::getInstance()->get(
			$this->idInfo->getItemId(),
			$this->writeStateToItemMeta()
		);
	}
}
