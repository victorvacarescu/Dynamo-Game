<?php

namespace Story\Skills;

class MagicShield implements ISkill {

	const NAME = "Magic shield";
	const CHANCE = 20;
	const VALUE = 1 / 2;

	public function shouldUse(): bool {
		return mt_rand(1, 100) <= self::CHANCE;
	}
	
	public function useSkill(): object {
		$skillInfo = new \stdClass();
		$skillInfo->name = self::NAME;
		$skillInfo->value = number_format(self::VALUE, 1);

		return $skillInfo;
	}
}