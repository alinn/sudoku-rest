<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 18/01/17
 * Time: 16:09
 */

namespace Tests\PuzzleBundle\Service;


use Prophecy\Argument;
use PuzzleBundle\Exception\EntityNotFoundException;
use PuzzleBundle\Exception\ValidationException;
use PuzzleBundle\Model\Puzzle;
use PuzzleBundle\Service\Persistence;
use PuzzleBundle\Service\Validation;

/**
 * Class ValidationTest
 * @package Tests\PuzzleBundle\Service
 */
class ValidationTest extends \PHPUnit_Framework_TestCase
{
    use SudokuReader;

    /**
     * @param Puzzle      $originalPuzzle
     * @param Puzzle      $puzzle
     * @param bool        $foundInDatabase
     * @param string|null $expectedException
     *
     * @dataProvider inputValidate
     */
    public function testValidate(Puzzle $originalPuzzle, Puzzle $puzzle, bool $foundInDatabase, string $expectedException = null)
    {
        $persistence = $this->prophesize(Persistence::class);
        if (null !== $expectedException) {
            static::expectException($expectedException);
        }
        if (null === $puzzle->getPuzzleId()) {
            $persistence->findOne(Argument::any())->shouldNotBeCalled();
        } else {
            if (true === $foundInDatabase) {
                $persistence->findOne($puzzle->getPuzzleId())->shouldBeCalledTimes(1)->willReturn($originalPuzzle);
            } else {
                $persistence->findOne($puzzle->getPuzzleId())->shouldBeCalledTimes(1)->willThrow($expectedException);
            }
        }
        $class = new Validation($persistence->reveal());
        $class->validate($puzzle);
    }

    public function inputValidate()
    {
        $puzzles = [
            [
                'id' => '1',
                'original' => [
                    [8,null,null,null,null,null,null,null,null,],
                    [null,null,null,null,null,null,5,null,7,],
                    [null,null,null,null,null,null,null,6,1,],
                    [null,1,null,null,8,6,9,null,5,],
                    [null,null,null,null,1,4,null,null,null,],
                    [null,9,6,5,null,null,null,null,4,],
                    [null,null,8,null,null,7,null,null,null,],
                    [7,5,null,3,null,null,null,null,9,],
                    [null,null,9,null,null,1,3,null,null,],
                ],
                'toValidate' => [
                    [8,null,null,null,null,null,null,null,null,],
                    [null,null,null,null,null,null,5,null,7,],
                    [null,null,null,null,null,null,null,6,1,],
                    [null,1,null,null,8,6,9,null,5,],
                    [null,null,null,null,1,4,null,null,null,],
                    [null,9,6,5,null,null,null,null,4,],
                    [null,null,8,null,null,7,null,null,null,],
                    [7,5,null,3,null,null,null,null,9,],
                    [null,null,9,null,null,1,3,null,null,],
                ],
                'size' => 3,
                'shouldBeFound' => true,
                'expectedException' => null
            ],
            [
                'id' => '1',
                'original' => [
                    [8,null,null,null,null,null,null,null,null,],
                    [null,null,null,null,null,null,5,null,7,],
                    [null,null,null,null,null,null,null,6,1,],
                    [null,1,null,null,8,6,9,null,5,],
                    [null,null,null,null,1,4,null,null,null,],
                    [null,9,6,5,null,null,null,null,4,],
                    [null,null,8,null,null,7,null,null,null,],
                    [7,5,null,3,null,null,null,null,9,],
                    [null,null,9,null,null,1,3,null,null,],
                ],
                'toValidate' => [
                    [9,null,null,null,null,null,null,null,null,],
                    [null,null,null,null,null,null,5,null,7,],
                    [null,null,null,null,null,null,null,6,1,],
                    [null,1,null,null,8,6,9,null,5,],
                    [null,null,null,null,1,4,null,null,null,],
                    [null,9,6,5,null,null,null,null,4,],
                    [null,null,8,null,null,7,null,null,null,],
                    [7,5,null,3,null,null,null,null,9,],
                    [null,null,9,null,null,1,3,null,null,],
                ],
                'size' => 3,
                'shouldBeFound' => true,
                'expectedException' => ValidationException::class
            ],
            [
                'id' => '1',
                'original' => [
                    [8,null,null,null,null,null,null,null,null,],
                    [null,null,null,null,null,null,5,null,7,],
                    [null,null,null,null,null,null,null,6,1,],
                    [null,1,null,null,8,6,9,null,5,],
                    [null,null,null,null,1,4,null,null,null,],
                    [null,9,6,5,null,null,null,null,4,],
                    [null,null,8,null,null,7,null,null,null,],
                    [7,5,null,3,null,null,null,null,9,],
                    [null,null,9,null,null,1,3,null,null,],
                ],
                'toValidate' => [],
                'size' => 3,
                'shouldBeFound' => false,
                'expectedException' => EntityNotFoundException::class
            ]
        ];
        $fixtures = [];
        foreach ($puzzles as $puzzle) {
            $fixtures[] = [
                $this->readFromMatrix($puzzle['original'], $puzzle['size'], $puzzle['id']),
                $this->readFromMatrix($puzzle['toValidate'], $puzzle['size'], $puzzle['id']),
                $puzzle['shouldBeFound'],
                $puzzle['expectedException']
            ];
        }
        return $fixtures;
    }

}
