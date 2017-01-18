<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 18/01/17
 * Time: 13:05
 */

namespace PuzzleBundle\Service;


use PuzzleBundle\Exception\EntityNotFoundException;
use PuzzleBundle\Model\Puzzle;
use PuzzleBundle\Model\PuzzleCollection;
use PuzzleBundle\Model\Square;

class ArrayStorage implements Persistence
{
    private $storage = [
        'c4ca4238a0b923820dcc509a6f75849b' => [
            'size' => 3,
            'grid' => [
                [7, null, null, null, 4, null, 5, 3, null],
                [null, null, 5, null, null, 8, null, 1, null],
                [null, null, 8, 5, null, 9, null, 4, null],
                [5, 3, 9, null, 6, null, null, null, 1],
                [null, null, null, null, 1, null, null, null, 5],
                [8, null, null, 7, 2, null, 9, null, null],
                [9, null, 7, 4, null, null, null, null, null],
                [null, null, null, null, 5, 7, null, null, null],
                [6, null, null, null, null, null, null, 5, null],
            ]
        ]
    ];

    public function findOne(string $id):Puzzle
    {
        if (!array_key_exists($id, $this->storage)) {
            throw new EntityNotFoundException($id);
        }
        $squares = [];
        foreach ($this->storage[$id]['grid'] as $row => $gridLine) {
            foreach ($gridLine as $col => $value) {
                $squares[]= new Square($col + 1, $row+1, $value, true);
            }
        }
        return new Puzzle($id, $squares, $this->storage[$id]['size']);
    }

    public function find(int $skip, int $count):PuzzleCollection
    {
        $puzzles = [];
        $results = array_slice($this->storage, $skip, $count);
        foreach ($results as $id => $result) {
            $squares = [];
            foreach ($result['grid'] as $row => $gridLine) {
                foreach ($gridLine as $col => $value) {
                    if (null === $value) {
                        continue;
                    }
                    $squares[]= new Square($col + 1, $row+1, $value, true);
                }
            }
            $puzzles[] = new Puzzle($id, $squares, $result['size']);
        }
        return new PuzzleCollection($puzzles, count($puzzles), count($this->storage), $skip);
    }

}