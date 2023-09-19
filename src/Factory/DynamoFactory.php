<?php

namespace Story\Factory;

use Story\Factory\ICharacterFactory;
use Story\Characters\Character;
use Story\Characters\Dynamo;
use Story\Skills\RapidStrike;
use Story\Skills\MagicShield;

class DynamoFactory implements ICharacterFactory {

    public static function create(array $stats): Character {
        $dynamo = new Dynamo($stats);
		$dynamo->addDefensiveSkill(new MagicShield());
		$dynamo->addOffensiveSkill(new RapidStrike());

        return $dynamo;
    }
}