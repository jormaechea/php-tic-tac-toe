<?php

namespace PhpTicTacToe\Test\Moves;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Moves\Center;
use \PhpTicTacToe\Positions\CurrentPlayerPosition;
use \PhpTicTacToe\Positions\OtherPlayerPosition;

class CenterTest extends TestCase {

	/**
	 * @board
	 * 	#|#|#
	 * 	#|C|#
	 * 	#|#|#
	 */
	public function testCurrentUserCenter() {

		$board = new Board();
		$board->setPosition(1, 1, new CurrentPlayerPosition());

		$centerMove = new Center();

		$this->assertFalse($centerMove->isPossible($board), "It shouldn't be possible to place in the center when it's a current user position");
	}

	/**
	 * @board
	 * 	#|#|#
	 * 	#|O|#
	 * 	#|#|#
	 */
	public function testOtherUserCenter() {

		$board = new Board();
		$board->setPosition(1, 1, new OtherPlayerPosition());

		$centerMove = new Center();

		$this->assertFalse($centerMove->isPossible($board), "It shouldn't be possible to place in the center when it's an other user position");
	}



	/**
	 * @board
	 * 	#|#|#
	 * 	#|#|#
	 * 	#|#|#
	 */
	public function testEmptyCenter() {

		$board = new Board();

		$centerMove = new Center();

		$this->assertTrue($centerMove->isPossible($board), "It should be possible to place in the center when it's empty");
		$this->assertTrue($centerMove->perform($board), "It should perform center move.");

		$centerPosition = $board->getPosition(1, 1);
		$this->assertTrue($centerPosition instanceOf CurrentPlayerPosition);
	}

}

?>