<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 18/01/17
 * Time: 16:57
 */

namespace Tests\PuzzleBundle\Service;


use PuzzleBundle\Model\Puzzle;
use PuzzleBundle\Model\Square;

trait SudokuReader
{
    /**
     * @param array  $matrix
     * @param int    $size
     * @param string $id
     * @return Puzzle
     */
    protected function readFromMatrix(array $matrix, int $size, string $id = null):Puzzle {

        $squares = [];
        foreach ($matrix as $rowCount => $row) {
            foreach ($row as $colCount => $value) {
                if (null === $value) {
                    continue;
                }
                $squares[] = new Square($rowCount + 1, $colCount + 1, $value);
            }
        }
        return new Puzzle($id, $squares, $size);
    }

}