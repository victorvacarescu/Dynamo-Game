<?php

namespace Story\Factory;

use Story\Factory\ICharacterFactory;
use Story\Characters\Character;
use Story\Characters\Beast;

class BeastFactory implements ICharacterFactory {

    public static function create(array $stats): Character {
        $beast = new Beast($stats);

        return $beast;
    }
}