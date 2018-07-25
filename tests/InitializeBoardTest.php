<?

namespace PhpTicTacToe\Test;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Board\Board;
use \PhpTicTacToe\Exceptions\OutOfRangeException;
use \PhpTicTacToe\Positions\Position;
use \PhpTicTacToe\Positions\EmptyPosition;

class InitializeBoardTest extends TestCase {

	public function testInitializeEmptyBoard() {

		$board = new Board();
		$this->assertTrue($board instanceOf $board);

		foreach(range(0,2) as $row) {
			foreach(range(0,2) as $column) {
				$position = $board->getPosition($row, $column);
				$this->assertTrue($position instanceOf EmptyPosition);
			}
		}
	}

	public function testGetSetPosition() {

		$row = 2;
		$column = 1;

		$position = $this->createMock("\\PhpTicTacToe\\Positions\\Position");

		$board = new Board();
		$board->setPosition($row, $column, $position);

		$boardPosition = $board->getPosition($row, $column);

		$this->assertSame($position, $boardPosition);
	}

	public function testSetEmptyPosition() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$position = $this->createMock("\\PhpTicTacToe\\Positions\\Position");

		$board = new Board();
		$board->setPosition(null, null, $position);
	}

	public function testSetPositionWithInvalidRow() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$row = 4;
		$column = 2;

		$position = $this->createMock("\\PhpTicTacToe\\Positions\\Position");

		$board = new Board();
		$board->setPosition($row, $column, $position);
	}

	public function testSetPositionWithInvalidColumn() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$row = 2;
		$column = -1;

		$position = $this->createMock("\\PhpTicTacToe\\Positions\\Position");

		$board = new Board();
		$board->setPosition($row, $column, $position);
	}

	public function testGetEmptyPosition() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$board = new Board();
		$board->getPosition(null, null);
	}

	public function testGetPositionWithInvalidRow() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$row = 3;
		$column = 1;

		$board = new Board();
		$board->getPosition($row, $column);
	}

	public function testGetPositionWithInvalidColumn() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$row = 0;
		$column = 11;

		$board = new Board();
		$board->getPosition($row, $column);
	}

	public function testGetRow() {

		$board = new Board();
		$row = $board->getRow(0);

		$this->assertTrue(is_array($row));
		$this->assertEquals(3, count($row));

		$this->assertTrue($row[0] instanceOf Position);
		$this->assertTrue($row[1] instanceOf Position);
		$this->assertTrue($row[2] instanceOf Position);
	}

	public function testGetInvalidRow() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$board = new Board();
		$board->getRow(3);
	}

	public function testGetColumn() {

		$board = new Board();
		$column = $board->getColumn(0);

		$this->assertTrue(is_array($column));
		$this->assertEquals(3, count($column));

		$this->assertTrue($column[0] instanceOf Position);
		$this->assertTrue($column[1] instanceOf Position);
		$this->assertTrue($column[2] instanceOf Position);
	}

	public function testGetInvalidColumn() {

		$this->expectException(\PhpTicTacToe\Exceptions\OutOfRangeException::class);

		$board = new Board();
		$board->getColumn(3);
	}

	public function testReplaceSuccess() {

		$board = new Board();
		$positionToReplace = $board->getPosition(0, 0);

		$newPosition = $this->createMock("\\PhpTicTacToe\\Positions\\Position");

		$wasReplaced = $board->replace($positionToReplace, $newPosition);

		$this->assertTrue($wasReplaced);
		$this->assertSame($newPosition, $board->getPosition(0, 0));
	}

	public function testReplacePositionNotInBoard() {

		$board = new Board();

		$originalPosition = $board->getPosition(0, 0);

		$positionToReplace = $this->createMock("\\PhpTicTacToe\\Positions\\Position");
		$newPosition = $this->createMock("\\PhpTicTacToe\\Positions\\Position");

		$wasReplaced = $board->replace($positionToReplace, $newPosition);

		$this->assertFalse($wasReplaced);
		$this->assertSame($originalPosition, $board->getPosition(0, 0));
	}
}

?>