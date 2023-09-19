<?php

namespace Story\Factory;

use Story\Characters\Character;
use Story\Battle\Battle;
use Story\Observers\BattleObserver;

class BattleFactory implements IBattleFactory {

	/**
	 * @param Character[] $characters
	 */
	public static function create($characters): Battle {
		$battleObserver = new BattleObserver();
		$battle = new Battle();
		$battle->addObserver($battleObserver);
		$battle->addFirstPlayer($characters[0]);
		$battle->addSecondPlayer($characters[1]);
		$battle->setInitialRoles();

		return $battle;
	}
}