<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 17/01/17
 * Time: 04:31
 */

namespace PuzzleBundle\Model;


class Puzzle
{
    /**
     * @var Square[]
     */
    private $squares = [];
    /**
     * @var int
     */
    private $size;

    /**
     * Puzzle constructor.
     * @param array $squares
     * @param int   $size
     */
    public function __construct(array $squares, int $size)
    {
        $this->squares = $squares;
        $this->size = $size;
    }


    /**
     * @return Square[]
     */
    public function getSquares()
    {
        return $this->squares;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size)
    {
        $this->size = $size;
    }
}