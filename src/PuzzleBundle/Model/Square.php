<?php
/**
 * Created by IntelliJ IDEA.
 * User: alin.nica@lendico.de
 * Date: 17/01/17
 * Time: 04:36
 */

namespace PuzzleBundle\Model;


use JMS\Serializer\Annotation as Serializer;

class Square
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $positionX;
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $positionY;
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $value;
    /**
     * @var bool
     * @Serializer\Type("boolean")
     */
    private $readonly;

    /**
     * Square constructor.
     * @param int  $positionX
     * @param int  $positionY
     * @param int  $value
     * @param bool $readonly
     */
    public function __construct(int $positionX, int $positionY, $value, $readonly = false)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->value = $value;
        $this->readonly = $readonly;
    }


    /**
     * @return int
     */
    public function getPositionX(): int
    {
        return $this->positionX;
    }

    /**
     * @return int
     */
    public function getPositionY(): int
    {
        return $this->positionY;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return boolean
     */
    public function isReadonly(): bool
    {
        return $this->readonly;
    }
}