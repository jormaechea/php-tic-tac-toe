<?

namespace PhpTicTacToe\Test\Moves;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Moves\Block;
use \PhpTicTacToe\Positions\CurrentPlayerPosition;
use \PhpTicTacToe\Positions\OtherPlayerPosition;

class BlockTest extends TestCase {

	/**
	 * @board
	 * 	#|#|#
	 * 	#|#|#
	 * 	#|#|#
	 */
	public function testEmptyBoard() {

		$board = new Board();

		$winMove = new Block();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to block with an empty board.");
	}

	/**
	 * @board
	 * 	#|#|#
	 * 	#|#|#
	 * 	#|#|O
	 */
	public function testOnlyOnePosition() {

		$board = new Board();
		$board->setPosition(2, 2, new OtherPlayerPosition());

		$winMove = new Block();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to block with only one position owned.");
	}

	/**
	 * @board
	 * 	O|O|W
	 * 	#|#|#
	 * 	#|#|#
	 */
	public function testBlockRow() {

		$board = new Board();
		$board->setPosition(0, 0, new OtherPlayerPosition());
		$board->setPosition(0, 1, new OtherPlayerPosition());

		$winMove = new Block();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to block with two in a row and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform block move.");

		$blockedPosition = $board->getPosition(0, 2);
		$this->assertTrue($blockedPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	#|W|#
	 * 	#|O|#
	 * 	#|O|#
	 */
	public function testBlockColumn() {

		$board = new Board();
		$board->setPosition(1, 1, new OtherPlayerPosition());
		$board->setPosition(2, 1, new OtherPlayerPosition());

		$winMove = new Block();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to block with two in a column and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform block move.");

		$winningPosition = $board->getPosition(0, 1);
		$this->assertTrue($winningPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	W|#|#
	 * 	#|C|#
	 * 	#|#|C
	 */
	public function testBlockDiagonal() {

		$board = new Board();
		$board->setPosition(1, 1, new OtherPlayerPosition());
		$board->setPosition(2, 2, new OtherPlayerPosition());

		$winMove = new Block();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to block with two in a diagonal and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform block move.");

		$winningPosition = $board->getPosition(0, 0);
		$this->assertTrue($winningPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	#|#|O
	 * 	#|W|#
	 * 	O|#|#
	 */
	public function testBlockReverseDiagonal() {

		$board = new Board();
		$board->setPosition(0, 2, new OtherPlayerPosition());
		$board->setPosition(2, 0, new OtherPlayerPosition());

		$winMove = new Block();

		$this->assertTrue($winMove->isPossible($board), "It should be possible to block with two in a diagonal and an empty position.");
		$this->assertTrue($winMove->perform($board), "It should perform block move.");

		$winningPosition = $board->getPosition(1, 1);
		$this->assertTrue($winningPosition instanceOf CurrentPlayerPosition);
	}

	/**
	 * @board
	 * 	#|#|#
	 * 	O|C|O
	 * 	#|#|#
	 */
	public function testBlockedRow() {

		$board = new Board();
		$board->setPosition(1, 0, new OtherPlayerPosition());
		$board->setPosition(1, 1, new CurrentPlayerPosition());
		$board->setPosition(1, 2, new OtherPlayerPosition());

		$winMove = new Block();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to block with two in a row and a current player's position.");
	}

	/**
	 * @board
	 * 	#|#|O
	 * 	#|#|O
	 * 	#|#|C
	 */
	public function testBlockedColumn() {

		$board = new Board();
		$board->setPosition(0, 2, new OtherPlayerPosition());
		$board->setPosition(1, 2, new OtherPlayerPosition());
		$board->setPosition(2, 2, new CurrentPlayerPosition());

		$winMove = new Block();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to block with two in a column and a current player's position.");
	}

	/**
	 * @board
	 * 	O|#|#
	 * 	#|O|#
	 * 	#|#|C
	 */
	public function testBlockedDiagonal() {

		$board = new Board();
		$board->setPosition(0, 0, new OtherPlayerPosition());
		$board->setPosition(1, 1, new OtherPlayerPosition());
		$board->setPosition(2, 2, new CurrentPlayerPosition());

		$winMove = new Block();

		$this->assertFalse($winMove->isPossible($board), "It shouldn't be possible to block with two in a diagonal and a current player's position.");
	}

}

?>