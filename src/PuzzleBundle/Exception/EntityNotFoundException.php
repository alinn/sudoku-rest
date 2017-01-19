<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 18/01/17
 * Time: 17:25
 */

namespace PuzzleBundle\Exception;


use Exception;

/**
 * Class EntityNotFoundException
 * @package PuzzleBundle\Exception
 */
class EntityNotFoundException extends \RuntimeException
{
    /**
     * EntityNotFoundException constructor.
     * @param string    $id Entity identifier
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($id, $code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf('Not found by %s', $id), $code, $previous);
    }


}