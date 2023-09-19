<?php

namespace Story\Factory;

use Story\Characters\Character;

interface ICharacterFactory {

    public static function create(array $stats): Character;
}