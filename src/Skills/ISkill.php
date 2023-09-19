<?php

namespace Story\Skills;

use Story\Characters\Character;

interface ISkill {
    public function shouldUse(): bool;
    public function useSkill(): object;
}