<?

namespace PhpTicTacToe\Moves;

use PhpTicTacToe\Board\Board;

interface Move {

	public function isPossible(Board $board);

	public function perform(Board $board);

}

?>