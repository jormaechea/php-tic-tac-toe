<?

namespace PhpTicTacToe\Moves;

use PhpTicTacToe\Board\Board;
use PhpTicTacToe\Positions\CurrentPlayerPosition;
use PhpTicTacToe\Positions\Position;

class Block implements Move {

	private $lineToBlock;

	public function isPossible(Board $board) {

		foreach(range(0, 2) as $index) {

			$row = $board->getRow($index);
			if($this->canBlockLine($row)) {
				$this->lineToBlock = $row;
				return true;
			}

			$column = $board->getColumn($index);
			if($this->canBlockLine($column)) {
				$this->lineToBlock = $column;
				return true;
			}

		}

		$diagonal = $board->getDiagonal();
		if($this->canBlockLine($diagonal)) {
			$this->lineToBlock = $diagonal;
			return true;
		}

		$reverseDiagonal = $board->getDiagonal(true);
		if($this->canBlockLine($reverseDiagonal)) {
			$this->lineToBlock = $reverseDiagonal;
			return true;
		}

		return false;
	}

	public function perform(Board $board) {

		$emptyPositions = array_filter($this->lineToBlock, function(Position $position) {
			return $position->isEmpty();
		});

		$positionToBlock = reset($emptyPositions);

		return $board->replace($positionToBlock, new CurrentPlayerPosition());
	}

	private function canBlockLine(array $line) {

		$opponentsPositions = array_filter($line, function(Position $position) {
			return $position->isOpponents();
		});

		if(count($opponentsPositions) !== 2) {
			return false;
		}

		$emptyPositions = array_filter($line, function(Position $position) {
			return $position->isEmpty();
		});

		if(count($emptyPositions) !== 1) {
			return false;
		}

		return true;
	}

}

?>