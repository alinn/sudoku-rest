<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 17/01/17
 * Time: 04:31
 */

namespace PuzzleBundle\Model;

use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;


/**
 * @Hateoas\Relation(
 *     name="self",
 *     href=@Hateoas\Route(name="puzzle_puzzle_getpuzzle", parameters={"puzzleId"="expr(object.getPuzzleId())"})
 * )
 *
 * Class Puzzle
 * @package PuzzleBundle\Model
 */
class Puzzle
{
    /**
     * @var Square[]
     * @Serializer\Type("array<PuzzleBundle\Model\Square>")
     */
    private $squares = [];
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $size;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $puzzleId;


    /**
     * Puzzle constructor.
     * @param string $puzzleId
     * @param array  $squares
     * @param int    $size
     */
    public function __construct(string $puzzleId = null, array $squares, int $size)
    {
        $this->squares = $squares;
        $this->size = $size;
        $this->puzzleId = $puzzleId;
    }

    /**
     * @return string
     */
    public function getPuzzleId()
    {
        return $this->puzzleId;
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