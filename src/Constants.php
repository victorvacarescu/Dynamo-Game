<?php

namespace Story;

class Constants
{
	const ROUND_ENDED_EVENT = "round_ended";
	const GAME_ENDED_EVENT = "game_ended";

	const MAX_ROUNDS = 20;

	const DYNAMO_STATS = [
		"name" => "Dynamo",
		"health" => [70, 100],
		"strength" => [70, 80],
		"defence" => [45, 55],
		"speed" => [40, 50],
		"luck" => [10, 30]
	];

	const BEAST_STATS = [
		"name" => "Beast",
		"health" => [60, 90],
		"strength" => [60, 90],
		"defence" => [40, 60],
		"speed" => [40, 60],
		"luck" => [25, 40]
	];
}
