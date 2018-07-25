<?php

namespace PhpTicTacToe\Moves;

use PhpTicTacToe\Board\Board;
use PhpTicTacToe\Positions\CurrentPlayerPosition;

class EmptySide implements Move {

	private $emptySidePosition;

	public function isPossible(Board $board) {

		$sides = [
			[0, 1],
			[1, 0],
			[1, 2],
			[2, 1]
		];

		foreach($sides as $side) {
			$position = $board->getPosition(...$side);
			if($position->isEmpty()) {
				$this->emptySidePosition = $position;
				return true;
			}
		}

		return false;
	}

	public function perform(Board $board) {
		return $board->replace($this->emptySidePosition, new CurrentPlayerPosition());
	}

}

?>