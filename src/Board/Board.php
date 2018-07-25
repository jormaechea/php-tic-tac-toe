<?php

namespace PhpTicTacToe\Board;

use PhpTicTacToe\Exceptions\OutOfRangeException;
use PhpTicTacToe\Positions\EmptyPosition;
use PhpTicTacToe\Positions\Position;

class Board {

	const MIN_ROW_OR_COLUMN_INDEX = 0;

	const MAX_ROW_OR_COLUMN_INDEX = 2;

	private $linearBoard;

	private $hashedBoard;

	public function __construct() {

		foreach(range(0, 8) as $linearPosition) {

			$position = new EmptyPosition();

			$this->linearBoard[$linearPosition] = $position;

			$row = floor($linearPosition / 3);
			$column = $linearPosition % 3;

			if(!isset($this->hashedBoard[$row])) {
				$this->hashedBoard[$row] = [];
			}
			$this->hashedBoard[$row][$column] =& $this->linearBoard[$linearPosition];

		}
	}

	private function isPositionValid($row, $column) {

		if($row === null && $column === null) {
			return false;
		}

		if($row !== null && (!is_int($row) || $row < self::MIN_ROW_OR_COLUMN_INDEX || $row > self::MAX_ROW_OR_COLUMN_INDEX)) {
			return false;
		}

		if($column !== null && (!is_int($column) || $column < self::MIN_ROW_OR_COLUMN_INDEX || $column > self::MAX_ROW_OR_COLUMN_INDEX)) {
			return false;
		}

		return true;
	}

	public function setPosition($row, $column, Position $position) {

		if(!$this->isPositionValid($row, $column)) {
			throw new OutOfRangeException(sprintf("Position index (%d, %d) is invalid.", $row, $column));
		}

		$this->hashedBoard[$row][$column] = $position;
	}

	public function getPosition($row, $column) {

		if(!$this->isPositionValid($row, $column)) {
			throw new OutOfRangeException(sprintf("Position index (%d, %d) is invalid.", $row, $column));
		}

		return $this->hashedBoard[$row][$column];
	}

	public function getRow($row) {

		if(!$this->isPositionValid($row, null)) {
			throw new OutOfRangeException(sprintf("Position row (%d) is invalid.", $row));
		}

		return $this->hashedBoard[$row];
	}

	public function getColumn($column) {

		if(!$this->isPositionValid(null, $column)) {
			throw new OutOfRangeException(sprintf("Position column (%d) is invalid.", $column));
		}

		return array_map(function($row) use($column) {
			return $row[$column];
		}, $this->hashedBoard);
	}

	public function getDiagonal($reverse = false) {

		$columns = range(0, 2);
		if(!empty($reverse)) {
			rsort($columns);
		}

		return array_map(function($row) use(&$columns) {

			$column = array_shift($columns);
			return $row[$column];

		}, $this->hashedBoard);
	}

	public function replace(Position $oldPosition, Position $newPosition) {

		foreach($this->linearBoard as $index => $position) {

			if($position === $oldPosition) {
				$this->linearBoard[$index] = $newPosition;
				return true;
			}

		}

		return false;
	}

}

?>