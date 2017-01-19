<?php

namespace PuzzleBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use PuzzleBundle\Exception\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        try {
            $puzzle = $this->get('puzzle.storage')->findOne($puzzleId);
        } catch (EntityNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return $this->handleView(
            $this->view(
                $puzzle,
                200,
                []
            )
        );
    }

    public function postSolution($puzzleId)
    {

    }
}
