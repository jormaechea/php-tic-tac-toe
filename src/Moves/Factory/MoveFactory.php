<?php

namespace PhpTicTacToe\Moves\Factory;

class MoveFactory {

	public function getAllMovesByPriority() {

		return [
			new \PhpTicTacToe\Moves\Win(),
			new \PhpTicTacToe\Moves\Block(),
			new \PhpTicTacToe\Moves\Fork(),
			new \PhpTicTacToe\Moves\BlockFork(),
			new \PhpTicTacToe\Moves\Center(),
			new \PhpTicTacToe\Moves\OppositeCorner(),
			new \PhpTicTacToe\Moves\EmptyCorner(),
			new \PhpTicTacToe\Moves\EmptySide()
		];
	}

}

?>