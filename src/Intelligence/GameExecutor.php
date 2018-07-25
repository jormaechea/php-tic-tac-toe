<?php

namespace PhpTicTacToe\Intelligence;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Moves\Factory\MoveFactory;
use \PhpTicTacToe\Exceptions\GameException;

class GameExecutor {

	private $board;

	private $moves;

	public function __construct(Board $board, MoveFactory $moveFactory = null) {

		$moveFactory = !empty($moveFactory) ? $moveFactory : new MoveFactory();

		$this->board = $board;
		$this->moves = $moveFactory->getAllMovesByPriority();
	}

	public function play() {

		foreach($this->moves as $move) {

			if($move->isPossible($this->board)) {
				return $move->perform($this->board);
			}
		}

		throw new GameException("No possible moves.");

	}

}