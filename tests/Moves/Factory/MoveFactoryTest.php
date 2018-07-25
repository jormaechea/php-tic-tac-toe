<?php

namespace PhpTicTacToe\Test\Moves\Factory;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Moves\Factory\MoveFactory;
use \PhpTicTacToe\Moves\Move;

class MoveFactoryTest extends TestCase {

	public function testGetAllMovesByPriority() {

		$factory = new MoveFactory();
		$moves = $factory->getAllMovesByPriority();

		$this->assertTrue(is_array($moves), "It should return an array of moves");

		foreach($moves as $move) {
			$this->assertInstanceOf(Move::class, $move, "It should be an instance of Move");
		}

	}

}

?>