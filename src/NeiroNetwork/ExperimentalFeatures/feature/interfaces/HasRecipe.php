<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\interfaces;

/**
 * そのアイテムを入手するためのレシピを提供する
 */
interface HasRecipe{

	public function recipe() : array;
}