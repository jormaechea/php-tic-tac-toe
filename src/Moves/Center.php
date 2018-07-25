<?php

namespace PhpTicTacToe\Moves;

use PhpTicTacToe\Board\Board;
use PhpTicTacToe\Positions\CurrentPlayerPosition;

class Center implements Move {

	private $winningLine;

	public function isPossible(Board $board) {
		return $board->getPosition(1, 1)->isEmpty();
	}

	public function perform(Board $board) {

		$board->setPosition(1, 1, new CurrentPlayerPosition());

		return true;
	}

}

?>