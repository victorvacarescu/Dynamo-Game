<?php

namespace Story\Observers;

use Story\Observers\IBattleObserver;
use Story\Constants;
use Story\Battle\Battle;
use Story\Characters\Character;

class BattleObserver implements IBattleObserver {

	/**
	 * @var Battle
	 */
	private $battle;

	/**
	 * @var Character
	 */
	private $attacker;

	/**
	 * @var Character
	 */
	private $defender;

	/**
	 * @var array
	 */
	private $specialSkillUsed;

    public function update(string $event, Battle $battle): void {
		$this->battle = $battle;
		$this->attacker = $battle->getAttacker();
		$this->defender = $battle->getDefender();
		$this->specialSkillUsed = $battle->getSpecialSkillUsed();
		
		switch ($event) {
            case Constants::ROUND_ENDED_EVENT:
				$this->printRoundResults();
                break;
            case Constants::GAME_ENDED_EVENT:
                $this->printGameResults();
                break;
        }
    }

	private function printRoundResults(): void {
		echo "Round: {$this->battle->getCurrentRound()}" . PHP_EOL;

		if ($this->battle->getDefenderWasLucky()) {
			echo "{$this->attacker->getName()} missed." . PHP_EOL;
			echo "Damage: 0" . PHP_EOL;
			echo "{$this->defender->getName()}'s health: {$this->defender->getHealth()}" . PHP_EOL;
			echo PHP_EOL;
			return;
		}

		echo "{$this->attacker->getName()} attacked {$this->defender->getName()}" . PHP_EOL;

		if (!empty($this->specialSkillUsed)) {
			foreach ($this->specialSkillUsed as $skill) {
				echo "$skill->playerName used a special skill: $skill->name" . PHP_EOL;
			}
		}

		echo "Damage: {$this->battle->getDamage()}" . PHP_EOL; 
		echo "{$this->defender->getName()}'s health: {$this->defender->getHealth()}" . PHP_EOL;
		echo PHP_EOL;
	}

	private function printGameResults(): void {
		echo "Battle ended, {$this->attacker->getName()} won!" . PHP_EOL;
	}
}