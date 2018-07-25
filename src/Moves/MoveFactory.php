<?

namespace PhpTicTacToe\Moves;

class MoveFactory {

	public static function getAllMovesByPriority() {

		return [
			Win::class,
			Block::class,
			Fork::class,
			BlockFork::class,
			Center::class,
			OppositeCorner::class,
			EmptyCorner::class,
			EmptySide::class
		];
	}

}

?>