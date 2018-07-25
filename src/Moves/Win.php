<?

namespace PhpTicTacToe\Moves;

use PhpTicTacToe\Board\Board;
use PhpTicTacToe\Positions\CurrentPlayerPosition;
use PhpTicTacToe\Positions\Position;

class Win implements Move {

	private $winningLine;

	public function isPossible(Board $board) {

		foreach(range(0, 2) as $index) {

			$row = $board->getRow($index);
			if($this->canWinLine($row)) {
				$this->winningLine = $row;
				return true;
			}

			$column = $board->getColumn($index);
			if($this->canWinLine($column)) {
				$this->winningLine = $column;
				return true;
			}

		}

		$diagonal = $board->getDiagonal();
		if($this->canWinLine($diagonal)) {
			$this->winningLine = $diagonal;
			return true;
		}

		$reverseDiagonal = $board->getDiagonal(true);
		if($this->canWinLine($reverseDiagonal)) {
			$this->winningLine = $reverseDiagonal;
			return true;
		}

		return false;
	}

	public function perform(Board $board) {

		$emptyPositions = array_filter($this->winningLine, function(Position $position) {
			return $position->isEmpty();
		});

		$winningPosition = reset($emptyPositions);

		return $board->replace($winningPosition, new CurrentPlayerPosition());
	}

	private function canWinLine(array $line) {

		$myPositions = array_filter($line, function(Position $position) {
			return $position->isMine();
		});

		if(count($myPositions) !== 2) {
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