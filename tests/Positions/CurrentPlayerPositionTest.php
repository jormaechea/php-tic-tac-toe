<?

namespace PhpTicTacToe\Test\Positions;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Positions\CurrentPlayerPosition;

class CurrentPlayerPositionTest extends TestCase {

	private $position;

	protected function setUp() {
		$this->position = new CurrentPlayerPosition();
	}

	public function testIsEmpty() {
		$this->assertFalse($this->position->isEmpty());
	}

	public function testIsMine() {
		$this->assertTrue($this->position->isMine());
	}

	public function testIsOpponents() {
		$this->assertFalse($this->position->isOpponents());
	}

}

?>