<?php

namespace PhpTicTacToe\Test\Moves;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Moves\EmptySide;
use \PhpTicTacToe\Positions\CurrentPlayerPosition;
use \PhpTicTacToe\Positions\OtherPlayerPosition;

class EmptySideTest extends TestCase {

	/**
	 * @board
	 * 	#|#|#
	 * 	#|#|#
	 * 	#|#|#
	 */
	public function testEmptyBoard() {

		$board = new Board();

		$emptySideMove = new EmptySide();

		$this->assertTrue($emptySideMove->isPossible($board), "It should be possible to place in a side with empty board");
		$this->assertTrue($emptySideMove->perform($board), "It should perform empty side move.");
	}

	/**
	 * @board
	 * 	#|C|#
	 * 	C|#|O
	 * 	#|#|#
	 */
	public function testOnlyOneSideAvailable() {

		$board = new Board();
		$board->setPosition(0, 1, new CurrentPlayerPosition());
		$board->setPosition(1, 0, new CurrentPlayerPosition());
		$board->setPosition(1, 2, new OtherPlayerPosition());

		$emptySideMove = new EmptySide();

		$this->assertTrue($emptySideMove->isPossible($board), "It should be possible to place in a side with one empty side");
		$this->assertTrue($emptySideMove->perform($board), "It should perform empty side move.");

		$sidePosition = $board->getPosition(2, 1);
		$this->assertTrue($sidePosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	#|C|#
	 * 	O|#|C
	 * 	#|O|#
	 */
	public function testNoSideAvailable() {

		$board = new Board();
		$board->setPosition(0, 1, new CurrentPlayerPosition());
		$board->setPosition(1, 0, new OtherPlayerPosition());
		$board->setPosition(1, 2, new CurrentPlayerPosition());
		$board->setPosition(2, 1, new OtherPlayerPosition());

		$emptySideMove = new EmptySide();

		$this->assertFalse($emptySideMove->isPossible($board), "It should be possible to place in a side without any empty side");
	}

}

?>