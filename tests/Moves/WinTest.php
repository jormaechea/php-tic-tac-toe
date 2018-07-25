<?php

namespace PhpTicTacToe\Test\Moves;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Moves\Win;
use \PhpTicTacToe\Positions\CurrentPlayerPosition;
use \PhpTicTacToe\Positions\OtherPlayerPosition;

class WinTest extends TestCase {

	/**
	 * @board
	 * 	#|#|#
	 * 	#|#|#
	 * 	#|#|#
	 */
	public function testEmptyBoard() {

		$board = new Board();

		$winMove = new Win();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to win with an empty board.");
	}

	/**
	 * @board
	 * 	#|#|#
	 * 	#|#|#
	 * 	#|#|C
	 */
	public function testOnlyOnePosition() {

		$board = new Board();
		$board->setPosition(2, 2, new CurrentPlayerPosition());

		$winMove = new Win();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to win with only one position owned.");
	}

	/**
	 * @board
	 * 	C|C|W
	 * 	#|#|#
	 * 	#|#|#
	 */
	public function testWinningRow() {

		$board = new Board();
		$board->setPosition(0, 0, new CurrentPlayerPosition());
		$board->setPosition(0, 1, new CurrentPlayerPosition());

		$winMove = new Win();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to win with two in a row and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform win move.");

		$winningPosition = $board->getPosition(0, 2);
		$this->assertTrue($winningPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	#|W|#
	 * 	#|C|#
	 * 	#|C|#
	 */
	public function testWinningColumn() {

		$board = new Board();
		$board->setPosition(1, 1, new CurrentPlayerPosition());
		$board->setPosition(2, 1, new CurrentPlayerPosition());

		$winMove = new Win();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to win with two in a column and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform win move.");

		$winningPosition = $board->getPosition(0, 1);
		$this->assertTrue($winningPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	W|#|#
	 * 	#|C|#
	 * 	#|#|C
	 */
	public function testWinningDiagonal() {

		$board = new Board();
		$board->setPosition(1, 1, new CurrentPlayerPosition());
		$board->setPosition(2, 2, new CurrentPlayerPosition());

		$winMove = new Win();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to win with two in a diagonal and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform win move.");

		$winningPosition = $board->getPosition(0, 0);
		$this->assertTrue($winningPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	#|#|C
	 * 	#|W|#
	 * 	C|#|#
	 */
	public function testWinningReverseDiagonal() {

		$board = new Board();
		$board->setPosition(0, 2, new CurrentPlayerPosition());
		$board->setPosition(2, 0, new CurrentPlayerPosition());

		$winMove = new Win();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to win with two in a diagonal and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform win move.");

		$winningPosition = $board->getPosition(1, 1);
		$this->assertTrue($winningPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	#|#|#
	 * 	C|O|C
	 * 	#|#|#
	 */
	public function testBlockedRow() {

		$board = new Board();
		$board->setPosition(1, 0, new CurrentPlayerPosition());
		$board->setPosition(1, 1, new OtherPlayerPosition());
		$board->setPosition(1, 2, new CurrentPlayerPosition());

		$winMove = new Win();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to win with two in a row and an other player's position.");
	}

	/**
	 * @board
	 * 	#|#|C
	 * 	#|#|C
	 * 	#|#|O
	 */
	public function testBlockedColumn() {

		$board = new Board();
		$board->setPosition(0, 2, new CurrentPlayerPosition());
		$board->setPosition(1, 2, new CurrentPlayerPosition());
		$board->setPosition(2, 2, new OtherPlayerPosition());

		$winMove = new Win();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to win with two in a column and an other player's position.");
	}

	/**
	 * @board
	 * 	C|#|#
	 * 	#|C|#
	 * 	#|#|O
	 */
	public function testBlockedDiagonal() {

		$board = new Board();
		$board->setPosition(0, 0, new CurrentPlayerPosition());
		$board->setPosition(1, 1, new CurrentPlayerPosition());
		$board->setPosition(2, 2, new OtherPlayerPosition());

		$winMove = new Win();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to win with two in a diagonal and an other player's position.");
	}

}

?>