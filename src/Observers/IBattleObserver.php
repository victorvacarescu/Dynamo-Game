<?php

namespace Story\Observers;

use Story\Battle\Battle;

interface IBattleObserver {
    public function update(string $event, Battle $battle): void;
}