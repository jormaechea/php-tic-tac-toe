<?php

namespace PhpTicTacToe\Intelligence;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Moves\MoveFactory;
use \PhpTicTacToe\Exceptions\GameException;

class GameExecutor {

	private $board;

	private $moves;

	public function __construct(Board $board, MoveFactory $moveFactory = null) {

		if(empty($moveFactory)) {
			$moveFactory = new MoveFactory();
		}

		$this->board = $board;
		$this->moves = $moveFactory->getAllMovesByPriority();
	}

	public function play() {

		foreach($this->moves as $moveName) {

			$move = new $moveName();

			if($move->isPossible($this->board)) {
				return $move->perform($this->board);
			}
		}

		throw new GameException("No possible moves.");

	}

}