<?php

namespace Story\Characters;

use Story\Skills\ISkill;

abstract class Character {
	private $name;
	private $health;
	private $strength;
	private $defence;
	private $speed;
	private $luck;
	private $defensiveSkills = [];
	private $offensiveSkills = [];

	public function __construct(array $stats) {
		$this->initialize($stats);
	}

	public function getName(): string {
		return $this->name;
	}

	public function setName($name): void {
		$this->name = $name;
	}

	public function getHealth(): int {
		return $this->health;
	}

	public function setHealth($health): void {
		$this->health = $health;
	}

	public function getStrength(): int {
		return $this->strength;
	}

	public function setStrength($strength): void {
		$this->strength = $strength;
	}

	public function getDefence(): int {
		return $this->defence;
	}

	public function setDefence($defence): void {
		$this->defence = $defence;
	}

	public function getSpeed(): int {
		return $this->speed;
	}

	public function setSpeed($speed): void {
		$this->speed = $speed;
	}

	public function getLuck(): int {
		return $this->luck;
	}

	public function setLuck($luck): void {
		$this->luck = $luck;
	}

	public function addDefensiveSkill(ISkill $skill): void {
		$this->defensiveSkills[] = $skill;
	}

	/**
	 * @return ISkill[]
	 */
	public function getDefensiveSkills(): array {
		return $this->defensiveSkills;
	}

	public function addOffensiveSkill(ISkill $skill): void {
		$this->offensiveSkills[] = $skill;
	}

	/**
	 * @return ISkill[]
	 */
	public function getOffensiveSkills(): array {
		return $this->offensiveSkills;
	}

	protected function initialize(array $stats): void {
		foreach ($stats as $key => $value) {
			switch ($key) {
				case 'name':
					$this->setName($value);
					break;
				case 'health':
					$this->setHealth(mt_rand($value[0], $value[1]));
					break;
				case 'strength':
					$this->setStrength(mt_rand($value[0], $value[1]));
					break;
				case 'defence':
					$this->setDefence(mt_rand($value[0], $value[1]));
					break;
				case 'speed':
					$this->setSpeed(mt_rand($value[0], $value[1]));
					break;
				case 'luck':
					$this->setLuck(mt_rand($value[0], $value[1]));
					break;
			}
		}
	}
}