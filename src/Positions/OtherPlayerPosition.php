<?php

namespace PhpTicTacToe\Positions;

class OtherPlayerPosition implements Position {

	public function isEmpty() {
		return false;
	}

	public function isMine() {
		return false;
	}

	public function isOpponents() {
		return true;
	}

}

?>