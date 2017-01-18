<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 18/01/17
 * Time: 13:02
 */

namespace PuzzleBundle\Service;


use PuzzleBundle\Exception\EntityNotFoundException;
use PuzzleBundle\Model\Puzzle;
use PuzzleBundle\Model\PuzzleCollection;

interface Persistence
{
    /**
     * @param string $id
     * @return Puzzle
     * @throws EntityNotFoundException
     */
    public function findOne(string $id):Puzzle;

    /**
     * @param int $skip
     * @param int $count
     * @return PuzzleCollection
     */
    public function find(int $skip, int $count):PuzzleCollection;
}