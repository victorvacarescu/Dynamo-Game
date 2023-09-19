<?php
namespace Tests;

require_once '../autoload.php';
require_once './helper.php';

use Story\Factory\DynamoFactory;
use Story\Factory\BeastFactory;
use Story\Factory\BattleFactory;
use Story\Characters\Character;

class BattleTest {
	public function testCharacterEmptyStats() {
		echo "testCharacterEmptyStats" . PHP_EOL;
		$dynamo = DynamoFactory::create([]);
		$beast = BeastFactory::create([]);
		assert($dynamo !== Character::class, "failed");
		assert($beast !== Character::class, "failed");
		echo "passed" . PHP_EOL;
	}
}

$battleTest = new BattleTest();
$battleTest->testCharacterEmptyStats();
