<?php

namespace pocketmine\block;

namespace NeiroNetwork\ExperimentalFeatures\block;

use NeiroNetwork\ExperimentalFeatures\block\tile\ExperimentalSign as TileSign;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockLegacyIds as Ids;
use pocketmine\block\BlockLegacyIdHelper;
use pocketmine\block\utils\TreeType;
use pocketmine\item\ItemIds;
use pocketmine\utils\AssumptionFailedError;

/**
 * @see BlockLegacyIdHelper
 */
class ExperimentalBlockLegacyIdHelper{

	public static function getWoodenFloorSignIdentifier(TreeType $treeType) : BID{
		switch($treeType->id()){
			case TreeType::OAK()->id():
				return new BID(Ids::SIGN_POST, 0, ItemIds::SIGN, TileSign::class);
			case TreeType::SPRUCE()->id():
				return new BID(Ids::SPRUCE_STANDING_SIGN, 0, ItemIds::SPRUCE_SIGN, TileSign::class);
			case TreeType::BIRCH()->id():
				return new BID(Ids::BIRCH_STANDING_SIGN, 0, ItemIds::BIRCH_SIGN, TileSign::class);
			case TreeType::JUNGLE()->id():
				return new BID(Ids::JUNGLE_STANDING_SIGN, 0, ItemIds::JUNGLE_SIGN, TileSign::class);
			case TreeType::ACACIA()->id():
				return new BID(Ids::ACACIA_STANDING_SIGN,0, ItemIds::ACACIA_SIGN, TileSign::class);
			case TreeType::DARK_OAK()->id():
				return new BID(Ids::DARKOAK_STANDING_SIGN, 0, ItemIds::DARKOAK_SIGN, TileSign::class);
		}
		throw new AssumptionFailedError("Switch should cover all wood types");
	}

	public static function getWoodenWallSignIdentifier(TreeType $treeType) : BID{
		switch($treeType->id()){
			case TreeType::OAK()->id():
				return new BID(Ids::WALL_SIGN, 0, ItemIds::SIGN, TileSign::class);
			case TreeType::SPRUCE()->id():
				return new BID(Ids::SPRUCE_WALL_SIGN, 0, ItemIds::SPRUCE_SIGN, TileSign::class);
			case TreeType::BIRCH()->id():
				return new BID(Ids::BIRCH_WALL_SIGN, 0, ItemIds::BIRCH_SIGN, TileSign::class);
			case TreeType::JUNGLE()->id():
				return new BID(Ids::JUNGLE_WALL_SIGN, 0, ItemIds::JUNGLE_SIGN, TileSign::class);
			case TreeType::ACACIA()->id():
				return new BID(Ids::ACACIA_WALL_SIGN, 0, ItemIds::ACACIA_SIGN, TileSign::class);
			case TreeType::DARK_OAK()->id():
				return new BID(Ids::DARKOAK_WALL_SIGN, 0, ItemIds::DARKOAK_SIGN, TileSign::class);
		}
		throw new AssumptionFailedError("Switch should cover all wood types");
	}
}