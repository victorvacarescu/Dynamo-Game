<?php

namespace Story\Factory;

use Story\Battle\Battle;
use Story\Characters\Character;

interface IBattleFactory {

	/**
	 * @param Character[] $characters
	 */
    public static function create($characters): Battle;
}