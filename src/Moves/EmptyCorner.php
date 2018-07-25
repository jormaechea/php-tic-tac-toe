<?php

namespace PhpTicTacToe\Moves;

use PhpTicTacToe\Board\Board;
use PhpTicTacToe\Positions\CurrentPlayerPosition;

class EmptyCorner implements Move {

	private $emptyCornerPosition;

	public function isPossible(Board $board) {

		$corners = [
			[0, 0],
			[0, 2],
			[2, 0],
			[2, 2]
		];

		foreach($corners as $corner) {
			$position = $board->getPosition(...$corner);
			if($position->isEmpty()) {
				$this->emptyCornerPosition = $position;
				return true;
			}
		}

		return false;
	}

	public function perform(Board $board) {
		return $board->replace($this->emptyCornerPosition, new CurrentPlayerPosition());
	}

}

?>