<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17\block;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;
use pocketmine\block\utils\AnyFacingTrait;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class BaseAmethystCluster extends Transparent{
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
		return [ExperimentalItems::fromString("amethyst_shard")->setCount(4)];
	}

	public function getDropsForIncompatibleTool(Item $item) : array{
		return [ExperimentalItems::fromString("amethyst_shard")->setCount(2)];
	}
}