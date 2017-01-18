<?php

namespace PuzzleBundle\Service;

use PuzzleBundle\Exception\VerificationException;
use PuzzleBundle\Model\Puzzle;

/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 17/01/17
 * Time: 04:19
 */
class Verification
{

    const SUB_GRIDS = 'subGrids';
    const ROWS = 'rows';
    const COLUMNS = 'columns';

    public function verify(Puzzle $puzzle):bool
    {
        $verificationMatrix = [
            self::COLUMNS   => [],
            self::ROWS      => [],
            self::SUB_GRIDS => [],
        ];
        if (0 === count($puzzle->getSquares())) {
            return false;
        }
        foreach ($puzzle->getSquares() as $square) {
            if (empty($square->getValue())) {
                continue;
            }
            $verificationMatrix[self::COLUMNS][$square->getPositionY()][] = $square->getValue();
            $verificationMatrix[self::ROWS][$square->getPositionX()][] = $square->getValue();
            $subGridId =
                sprintf(
                    '%d-%d',
                    floor(($square->getPositionX() - 1) / $puzzle->getSize()) + 1,
                    floor(($square->getPositionY() - 1) / $puzzle->getSize()) + 1
                );
            $verificationMatrix[self::SUB_GRIDS][$subGridId][] = $square->getValue();
        }
        $cmpSum = 0;
        $setSize = pow($puzzle->getSize(), 2);
        for ($i = 1, $iMax = $setSize; $i <= $iMax; $i++) {
            $cmpSum |= pow(2, $i);
        }

        foreach ($verificationMatrix as $vfItem => $vfList) {


            foreach ($vfList as $setNr => $set) {
                $setId = sprintf('%s %s', $vfItem, $setNr);
                try {
                    $this->verifySet($setSize, $set, $setId, $cmpSum);
                } catch (\RuntimeException $e) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param int    $setSize
     * @param int[]  $set
     * @param string $setId
     * @param  int   $cmpSum
     * @throws VerificationException
     */
    private function verifySet(int $setSize, array $set, string $setId, int $cmpSum):void
    {
        if ($setSize !== count($set)) {
            throw new VerificationException('Unexpected size ' . count($set), $setId);
        }
        $sum = 0;
        foreach ($set as $value) {
            $sum |= pow(2, $value);
        }
        if ($cmpSum !== $sum) {
            throw new VerificationException('Set is not correct', $setId);
        }
    }
}

