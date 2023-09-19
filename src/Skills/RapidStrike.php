<?php

namespace Story\Skills;

class RapidStrike implements ISkill {

	const NAME = "Rapid strike";
	const CHANCE = 10;
	const VALUE = 1 * 2;

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