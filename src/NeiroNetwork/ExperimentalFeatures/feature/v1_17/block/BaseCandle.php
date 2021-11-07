<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17\block;

use pocketmine\block\Block;
use pocketmine\block\Transparent;
use pocketmine\item\Durable;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\FlintSteel;
use pocketmine\item\Item;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;
use pocketmine\world\sound\FlintSteelSound;

class BaseCandle extends Transparent{

	protected int $count = 1;
	protected bool $lighting = false;

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->count = ($stateMeta & 0b11) + 1;
		$this->lighting = ($stateMeta & 0b100) !== 0;
	}

	protected function writeStateToMeta() : int{
		return ($this->count - 1) | ($this->lighting ? 0b100 : 0);
	}

	public function getStateBitmask() : int{
		return 0b111;
	}

	public function getCount() : int{
		return $this->count;
	}

	public function setCount(int $count) : self{
		if($count < 1 || $count > 4){
			throw new \InvalidArgumentException("Count must be in range 1-4");
		}
		$this->count = $count;
		return $this;
	}

	public function isLighting() : bool{
		return $this->lighting;
	}

	public function setUnderwater(bool $lighting) : self{
		$this->lighting = $lighting;
		return $this;
	}

	public function isSolid() : bool{
		return false;
	}

	public function getLightLevel() : int{
		return $this->lighting ? $this->count * 3 : 0;
	}

	protected function recalculateCollisionBoxes() : array{
		return [
			AxisAlignedBB::one()
				->trim(Facing::UP, 10 / 16)
				->squash(Axis::X, 3 / 16)
				->squash(Axis::Z, 3 / 16)
		];
	}

	public function canBePlacedAt(Block $blockReplace, Vector3 $clickVector, int $face, bool $isClickedBlock) : bool{
		return $blockReplace instanceof self || parent::canBePlacedAt($blockReplace, $clickVector, $face, $isClickedBlock);
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($blockReplace->getSide(Facing::DOWN)->isTransparent()){
			return false;
		}

		if($blockReplace instanceof self and $blockReplace->count < 4){
			$this->count = $blockReplace->count + 1;
		}

		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if(!$this->lighting && ($item instanceof FlintSteel || $item->hasEnchantment(VanillaEnchantments::FIRE_ASPECT()))){
			if($item instanceof Durable){
				$item->applyDamage(1);
			}
			$this->lighting = true;
			$this->position->world->setBlock($this->position, $this);
			$this->position->world->addSound($this->position->add(0.5, 0.5, 0.5), new FlintSteelSound());
			return true;
		}
		return false;
	}

	public function getDropsForCompatibleTool(Item $item) : array{
		return [$this->asItem()->setCount($this->count)];
	}

	public function onNearbyBlockChange() : void{
		if($this->getSide(Facing::DOWN)->isTransparent()){
			$this->position->world->useBreakOn($this->position);
		}
	}
}