<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 17/01/17
 * Time: 04:36
 */

namespace Tests\PuzzleBundle\Service;


use PuzzleBundle\Model\Puzzle;
use PuzzleBundle\Model\Square;
use PuzzleBundle\Service\Verification;

/**
 * Class VerificationTest
 * @package Tests\PuzzleBundle\Service
 */
class VerificationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider inputVerify
     *
     * @param Puzzle $puzzle
     * @param bool   $correct
     */
    public function testVerify(Puzzle $puzzle, bool $correct)
    {
        $class = new Verification();
        static::assertEquals($correct, $class->verify($puzzle));
    }

    public function inputVerify()
    {
        $puzzles = [
            [
                'grid'    => [],
                'size' => 3,
                'correct' => false,
            ],
            [
                'grid'    => [
                    [3, 4, 8, 5, 6, 1, 2, 9, 7],
                    [5, 7, 9, 8, 2, 3, 6, 4, 1],
                    [6, 2, 1, 7, 4, 9, 8, 5, 3],
                    [2, 5, 3, 6, 9, 7, 4, 1, 8],
                    [1, 8, 6, 2, 5, 4, 7, 3, 9],
                    [7, 9, 4, 1, 3, 8, 5, 2, 6],
                    [9, 6, 7, 4, 1, 5, 3, 8, 2],
                    [8, 3, 5, 9, 7, 2, 1, 6, 4],
                    [4, 1, 2, 3, 8, 6, 9, 7, 5],
                ],
                'size' => 3,
                'correct' => true,
            ],
            [
                'grid'    => [
                    [6, 2, 1, 4, 5, 8, 3, 7, 9],
                    [4, 3, 9, 6, 7, 1, 8, 2, 5],
                    [5, 8, 7, 2, 3, 9, 4, 1, 6],
                    [7, 1, 3, 9, 4, 2, 6, 5, 8],
                    [2, 5, 8, 3, 6, 7, 9, 4, 1],
                    [9, 6, 4, 1, 8, 5, 7, 3, 2],
                    [8, 9, 5, 7, 1, 3, 2, 6, 4],
                    [1, 7, 6, 8, 2, 4, 5, 9, 3],
                    [3, 4, 2, 5, 9, 6, 1, 8, 7],
                ],
                'size' => 3,
                'correct' => true,
            ],
            [
                'grid'    => [
                    [6, 2, 1, 4, 5, 8, 3, 7, 9],
                    [4, 3, 9, 6, 7, 1, 8, 2, 5],
                    [5, 8, 7, 2, 3, 9, 4, 4, 6],
                    [7, 1, 3, 9, 4, 2, 6, 5, 8],
                    [2, 5, 8, 3, 6, 7, 9, 4, 1],
                    [9, 6, 4, 1, 8, 5, 7, 3, 2],
                    [8, 9, 5, 7, 1, 3, 2, 6, 4],
                    [1, 7, 6, 8, 2, 4, 5, 9, 3],
                    [3, 4, 2, 5, 9, 6, 1, 8, 7],
                ],
                'size' => 3,
                'correct' => false,
            ],
            [
                'grid'    => [
                    [6, 2, 1, 4, 5, 8, 3, 7, 9],
                    [4, 3, 9, 6, 7, 1, 8, 2, 5],
                    [5, 8, 7, 2, 3, 9, 4, 4, 6],
                    [7, 1, 3, 9, 4, 2, 6, 5, 8],
                    [2, 5, 8, 3, 6, 7, 9, 4, 1],
                    [9, 6, 4, 1, 8, 5, 7, 3],
                    [8, 9, 5, 7, 1, 3, 2, 6, 4],
                    [1, 7, 6, 8, 2, 4, 5, 9, 3],
                    [3, 4, 2, 5, 9, 6, 1, 8, 7],
                ],
                'size' => 3,
                'correct' => false,
            ]
        ];
        $fixtures = [];
        foreach ($puzzles as $puzzle) {
            $squares = [];
            foreach ($puzzle['grid'] as $rowCount => $row) {
                foreach ($row as $colCount => $value) {
                    $squares[] = new Square($rowCount + 1, $colCount + 1, $value);
                }
            }
            $fixtures[] = [new Puzzle($squares, $puzzle['size']), $puzzle['correct']];

        }

        return $fixtures;
    }
}
