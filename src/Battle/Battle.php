<?php declare(strict_types=1);

namespace Story\Battle;

use Story\Factory\ICharacterFactory;
use Story\Observers\IBattleObserver;
use Story\Characters\Character;
use Story\Constants;

class Battle {

	/**
	 * @var bool
	 */
	private $defenderWasLucky = false;

	/**
	 * @var int
	 */
	private $currentRound = 0;

	/**
	 * @var array[
	 */
	private $observers = [];

	/**
     * @var array
     */
	private $specialSkillUsed = [];

	/**
	 * @var Character
	 */
	private $firstPlayer;

	/**
	 * @var Character
	 */
	private $secondPlayer;

	/**
	 * @var Character
	 */
	private $attacker;

	/**
	 * @var Character
	 */
	private $defender;

	/**
	 * @var float
	 */
	private $damage;

	public function __construct() {
		
	}

	public function addObserver(IBattleObserver $observer): void {
		$this->observers[] = $observer;
	}

	public function addFirstPlayer(Character $firstPlayer): void {
		$this->firstPlayer = $firstPlayer;
	}

	public function addSecondPlayer(Character $secondPlayer): void {
		$this->secondPlayer = $secondPlayer;
	}

	public function start(): void {
		for ($round = 1; $round <= Constants::MAX_ROUNDS ; $round++) {
			$this->currentRound = $round;
			
			if ($this->battleEnded()) {
				break;
			}

			$this->playRound();
		}

		$this->printBattleResults();
	}

	public function getCurrentRound(): int {
		return $this->currentRound;
	}

	public function getAttacker(): Character {
		return $this->attacker;
	}

	public function getDefender(): Character {
		return $this->defender;
	}

	public function getDamage(): float {
		return $this->damage;
	}

	public function getSpecialSkillUsed(): array {
		return $this->specialSkillUsed;
	}

	public function setInitialRoles(): void {
		if ($this->firstPlayer->getSpeed() === $this->secondPlayer->getSpeed())
		{
			$this->attacker = $this->firstPlayer->getLuck() > $this->secondPlayer->getLuck() ? $this->firstPlayer : $this->secondPlayer;
			$this->defender = $this->attacker === $this->firstPlayer ? $this->secondPlayer : $this->firstPlayer;

			return;
		}

		$this->attacker = $this->firstPlayer->getSpeed() > $this->secondPlayer->getSpeed() ? $this->firstPlayer : $this->secondPlayer;
		$this->defender = $this->attacker === $this->firstPlayer ? $this->secondPlayer : $this->firstPlayer;
	}

	public function getDefenderWasLucky(): bool {
		return $this->defenderWasLucky;
	}

	private function setDamageValue(): void {
		$this->damage = $this->attacker->getStrength() - $this->defender->getDefence();

		if ($this->defenderWasLucky) {
			$this->damage = 0;
		}

		$this->checkIfSpecialSkillWereUsed();

		$this->damage = floatval($this->damage);
	}

	private function useSpecialSkills(array $skills, string $playerName): void {
		if (!empty($skills)) {
			foreach ($skills as $skill) {
				if ($skill->shouldUse()) {
					$skillInfo = $skill->useSkill();
					$skillInfo->playerName = $playerName;
					$this->specialSkillUsed[] = $skillInfo;
				}
			}
		}
	}

	private function setDefenderHealth(): void {
		$health = $this->defender->getHealth() - $this->damage;

		if ($health < 0) {
			$health = 0;
		}

		$this->defender->setHealth($health);
	}

	private function notifyObservers(string $event): void {
		foreach ($this->observers as $observer) {
			$observer->update($event, $this);
		}
	}

	private function playRound(): void {
		if ($this->currentRound > 1) {
			$this->switchRoles();
		}

		$this->resetSpecialSkillsUsed();
		$this->checkDefenderLuck();
		$this->setDamageValue();
		$this->setDefenderHealth();
		$this->outputRoundResults();
	}

	private function switchRoles(): void {
		$attackerCopy = $this->attacker;
		$this->attacker = $this->defender;
		$this->defender = $attackerCopy;
	}

	private function resetSpecialSkillsUsed(): void {
		$this->specialSkillUsed = [];
	}

	private function checkDefenderLuck(): void {
		$this->defenderWasLucky = mt_rand(0, 100) <= $this->defender->getLuck();
	}

	private function checkIfSpecialSkillWereUsed(): void {
		$this->useSpecialSkills($this->defender->getDefensiveSkills(), $this->defender->getName());
		$this->useSpecialSkills($this->attacker->getOffensiveSkills(), $this->attacker->getName());

		if (!empty($this->specialSkillUsed)) {
			foreach ($this->specialSkillUsed as $skill) {
				$this->damage *= $skill->value;
			}
		}
	}

	private function battleEnded(): bool {
		if($this->defender->getHealth() === 0 || $this->currentRound === 20)
		{
			return true;
		}

		return false;
	} 

	private function outputRoundResults(): void {
		$this->notifyObservers(Constants::ROUND_ENDED_EVENT);
	}

	private function printBattleResults(): void {
		$this->notifyObservers(Constants::GAME_ENDED_EVENT);
	}
}
