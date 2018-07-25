<?php

namespace PhpTicTacToe\Moves;

use PhpTicTacToe\Board\Board;

class EmptySide implements Move {

	private $winningLine;

	public function isPossible(Board $board) {
		return false;
	}

	public function perform(Board $board) {
		return false;
	}

}

?>