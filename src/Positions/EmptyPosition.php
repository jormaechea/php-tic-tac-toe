<?php

namespace PhpTicTacToe\Positions;

class EmptyPosition implements Position {

	public function isEmpty() {
		return true;
	}

	public function isMine() {
		return false;
	}

	public function isOpponents() {
		return false;
	}

}

?>