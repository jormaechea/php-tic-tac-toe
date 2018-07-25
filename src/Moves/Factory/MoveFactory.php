<?php

namespace PhpTicTacToe\Moves\Factory;

class MoveFactory {

	public function getAllMovesByPriority() {

		return [
			Win::class,
			Block::class,
			Fork::class,
			BlockFork::class,
			Center::class,
			OppositeCorner::class,
			EmptyCorner::class,
			EmptySide::class
		];
	}

}

?>