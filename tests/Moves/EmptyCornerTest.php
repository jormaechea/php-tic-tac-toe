<?php

namespace PhpTicTacToe\Test\Moves;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Moves\EmptyCorner;
use \PhpTicTacToe\Positions\CurrentPlayerPosition;
use \PhpTicTacToe\Positions\OtherPlayerPosition;

class EmptyCornerTest extends TestCase {

	/**
	 * @board
	 * 	#|#|#
	 * 	#|#|#
	 * 	#|#|#
	 */
	public function testEmptyBoard() {

		$board = new Board();

		$emptyCornerMove = new EmptyCorner();

		$this->assertTrue($emptyCornerMove->isPossible($board), "It should be possible to place in a corner with empty board");
		$this->assertTrue($emptyCornerMove->perform($board), "It should perform empty corner move.");
	}

	/**
	 * @board
	 * 	C|#|C
	 * 	#|#|#
	 * 	O|#|#
	 */
	public function testOnlyOneCornerAvailable() {

		$board = new Board();
		$board->setPosition(0, 0, new CurrentPlayerPosition());
		$board->setPosition(0, 2, new CurrentPlayerPosition());
		$board->setPosition(2, 0, new OtherPlayerPosition());

		$emptyCornerMove = new EmptyCorner();

		$this->assertTrue($emptyCornerMove->isPossible($board), "It should be possible to place in a corner with one empty corner");
		$this->assertTrue($emptyCornerMove->perform($board), "It should perform empty corner move.");

		$cornerPosition = $board->getPosition(2, 2);
		$this->assertTrue($cornerPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	C|#|C
	 * 	#|#|#
	 * 	O|#|O
	 */
	public function testNoCornerAvailable() {

		$board = new Board();
		$board->setPosition(0, 0, new CurrentPlayerPosition());
		$board->setPosition(0, 2, new CurrentPlayerPosition());
		$board->setPosition(2, 0, new OtherPlayerPosition());
		$board->setPosition(2, 2, new OtherPlayerPosition());

		$emptyCornerMove = new EmptyCorner();

		$this->assertFalse($emptyCornerMove->isPossible($board), "It should be possible to place in a corner without any empty corner");
	}

}

?>