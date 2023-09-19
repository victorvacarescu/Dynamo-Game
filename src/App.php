<?php

namespace Story;

use Story\Factory\DynamoFactory;
use Story\Factory\BeastFactory;
use Story\Factory\BattleFactory;
use Story\Constants;

class App {

	public static function init() {
		$dynamo = DynamoFactory::create(Constants::DYNAMO_STATS);
		$beast = BeastFactory::create(Constants::BEAST_STATS);
		$battle = BattleFactory::create([$dynamo, $beast]);

		$battle->start();
	}
}