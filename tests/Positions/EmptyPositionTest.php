<?

namespace PhpTicTacToe\Test\Positions;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Positions\EmptyPosition;

class EmptyPositionTest extends TestCase {

	private $position;

	protected function setUp() {
		$this->position = new EmptyPosition();
	}

	public function testIsEmpty() {
		$this->assertTrue($this->position->isEmpty());
	}

	public function testIsMine() {
		$this->assertFalse($this->position->isMine());
	}

	public function testIsOpponents() {
		$this->assertFalse($this->position->isOpponents());
	}

}

?>