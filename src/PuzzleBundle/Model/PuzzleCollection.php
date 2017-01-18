<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 18/01/17
 * Time: 13:18
 */

namespace PuzzleBundle\Model;


class PuzzleCollection
{
    /**
     * @var Puzzle[]
     */
    private $puzzles = [];

    private $count;

    private $totalCount;

    private $skipped;

    /**
     * PuzzleCollection constructor.
     * @param Puzzle[] $puzzles
     * @param          $count
     * @param          $totalCount
     * @param          $skipped
     */
    public function __construct(array $puzzles, $count, $totalCount, $skipped)
    {
        $this->puzzles = $puzzles;
        $this->count = $count;
        $this->totalCount = $totalCount;
        $this->skipped = $skipped;
    }

    /**
     * @return Puzzle[]
     */
    public function getPuzzles(): array
    {
        return $this->puzzles;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @return mixed
     */
    public function getSkipped()
    {
        return $this->skipped;
    }


}