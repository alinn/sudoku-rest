<?php

namespace PuzzleBundle\Controller;

use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\Controller\FOSRestController;
use PuzzleBundle\Model\Puzzle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PuzzleController
 * @package PuzzleBundle\Controller
 */
class PuzzleController extends FOSRestController
{
    /**
     * @param Request $request
     *
     * @Route("/puzzles")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPuzzles(Request $request)
    {
        $puzzles = $this->get('puzzle.storage')->find(
            $request->get('skip', 0),
            $request->get('count', 100)
        );

        return $this->handleView(
            $this->view(
                $puzzles->getPuzzles(),
                200,
                [
                    'X-Count'      => $puzzles->getCount(),
                    'X-TotalCount' => $puzzles->getTotalCount(),
                    'X-Skipped'    => $puzzles->getSkipped()
                ]
            )
        );

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/puzzles")
     * @Method("HEAD")
     *
     */
    public function headPuzzles(Request $request)
    {
        $puzzles = $this->get('puzzle.storage')->find(
            $request->get('skip', 0),
            $request->get('count', 100)
        );

        return $this->handleView(
            $this->view(
                null,
                200,
                [
                    'X-Count'      => $puzzles->getCount(),
                    'X-TotalCount' => $puzzles->getTotalCount(),
                    'X-Skipped'    => $puzzles->getSkipped()
                ]
            )
        );

    }

    /**
     * @param $puzzleId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/puzzles/{puzzleId}")
     * @Method("GET")
     *
     */
    public function getPuzzle($puzzleId)
    {
        $puzzle = $this->get('puzzle.storage')->findOne($puzzleId);

        return $this->handleView(
            $this->view(
                $puzzle,
                200,
                []
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/puzzles/{puzzleId}/solution")
     * @REST\RequestParam(name="squares", nullable=false)
     * @REST\RequestParam(name="size", nullable=false)
     * @Method("POST")
     */
    public function postPuzzleSolution(Request $request)
    {

        /** @var Puzzle $data */
        $data = $this->get('jms_serializer')->deserialize($request->getContent(), Puzzle::class, 'json');

        $this->get('puzzle.validation')->validate($data);
        $result = $this->get('puzzle.verification')->verify($data);
        if (true === $result) {
            return $this->handleView($this->view(null, 201));
        }

        return $this->handleView($this->view(['message' => 'Solution is not correct or incomplete'], 422));
    }
}
