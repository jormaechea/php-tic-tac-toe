<?php

namespace PhpTicTacToe\Moves\Factory;

class MoveFactory {

	public function getAllMovesByPriority() {

		return [
			\PhpTicTacToe\Moves\Win::class,
			\PhpTicTacToe\Moves\Block::class,
			\PhpTicTacToe\Moves\Fork::class,
			\PhpTicTacToe\Moves\BlockFork::class,
			\PhpTicTacToe\Moves\Center::class,
			\PhpTicTacToe\Moves\OppositeCorner::class,
			\PhpTicTacToe\Moves\EmptyCorner::class,
			\PhpTicTacToe\Moves\EmptySide::class
		];
	}

}

?>