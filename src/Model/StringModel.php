<?php
namespace Tonis\View\Model;

use Tonis\View\ModelInterface;

class StringModel implements ModelInterface
{
    /** @var string */
    private $string;

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }
}
