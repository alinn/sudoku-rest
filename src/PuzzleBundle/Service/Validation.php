<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 18/01/17
 * Time: 13:23
 */

namespace PuzzleBundle\Service;

use PuzzleBundle\Exception\ValidationException;
use PuzzleBundle\Model\Puzzle;

/**
 * Class Validation
 * @package PuzzleBundle\Service
 */
class Validation
{
    /**
     * @var Persistence
     */
    private $persistence;

    /**
     * Validation constructor.
     * @param Persistence $persistence
     */
    public function __construct(Persistence $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * @param Puzzle $puzzle
     * @throws \PuzzleBundle\Exception\ValidationException
     * @throws \PuzzleBundle\Exception\EntityNotFoundException
     */
    public function validate(Puzzle $puzzle)
    {
        if (null === $puzzle->getPuzzleId()) {
            throw new ValidationException('Puzzle cannot be validated as it is not recognized');
        }
        $originalPuzzle = $this->persistence->findOne($puzzle->getPuzzleId());

        foreach ($originalPuzzle->getSquares() as $originalSquare) {
            foreach ($puzzle->getSquares() as $square) {
                if ($originalSquare->getPositionX() == $square->getPositionX() &&
                    $originalSquare->getPositionY() == $square->getPositionY()
                ) {
                    if ($originalSquare->getValue() != $square->getValue()) {
                        throw new ValidationException('Read only values have been modified');
                    }
                }
            }
        }
    }

}