<?php

namespace PhpTicTacToe\Positions;

class CurrentPlayerPosition implements Position {

	public function isEmpty() {
		return false;
	}

	public function isMine() {
		return true;
	}

	public function isOpponents() {
		return false;
	}

}

?>