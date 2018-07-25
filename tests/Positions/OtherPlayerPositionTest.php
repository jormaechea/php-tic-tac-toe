<?php

namespace PhpTicTacToe\Test\Positions;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Positions\OtherPlayerPosition;

class OtherPlayerPositionTest extends TestCase {

	private $position;

	protected function setUp() {
		$this->position = new OtherPlayerPosition();
	}

	public function testIsEmpty() {
		$this->assertFalse($this->position->isEmpty());
	}

	public function testIsMine() {
		$this->assertFalse($this->position->isMine());
	}

	public function testIsOpponents() {
		$this->assertTrue($this->position->isOpponents());
	}

}

?>