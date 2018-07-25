<?php

namespace PhpTicTacToe\Test\Intelligence;

use \PHPUnit\Framework\TestCase;

use \PhpTicTacToe\Intelligence\GameExecutor;

class GameExecutorTest extends TestCase {

	public function testGamePlayWithoutMoves() {

		$this->expectException(\PhpTicTacToe\Exceptions\GameException::class);

		$board = $this->createMock("\\PhpTicTacToe\\Board\\Board");

		$factory = $this->createMock("\\PhpTicTacToe\\Moves\\Factory\\MoveFactory");
		$factory->method("getAllMovesByPriority")
			->willReturn([
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$this->createMock("\\PhpTicTacToe\\Moves\\Move")
			]);

		$gameExecutor = new GameExecutor($board, $factory);
		$gameExecutor->play();
	}

	public function testGamePlayWithMoves() {

		$board = $this->createMock("\\PhpTicTacToe\\Board\\Board");

		$validMove = $this->createMock("\\PhpTicTacToe\\Moves\\Move");

		$validMove->expects($this->once())
			->method("isPossible")
			->with($board)
			->willReturn(true);

		$validMove->expects($this->once())
			->method("perform")
			->with($board)
			->willReturn(true);

		$factory = $this->createMock("\\PhpTicTacToe\\Moves\\Factory\\MoveFactory");
		$factory->method("getAllMovesByPriority")
			->willReturn([
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$this->createMock("\\PhpTicTacToe\\Moves\\Move"),
				$validMove
			]);


		$gameExecutor = new GameExecutor($board, $factory);
		$playResult = $gameExecutor->play();

		$this->assertTrue($playResult);
	}

}

?>