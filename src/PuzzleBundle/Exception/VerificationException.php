<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 17/01/17
 * Time: 20:02
 */

namespace PuzzleBundle\Exception;

use Exception;

/**
 * Class ValidationException
 * @package PuzzleBundle\Exception
 */
class VerificationException extends \RuntimeException
{
    public function __construct($position, $message, $code = 0 , Exception $previous = null )
    {
        parent::__construct("$message at $position", $code, $previous);
    }


}