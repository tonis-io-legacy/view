<?php
namespace Tonis\View\Model;

use Tonis\View\ModelInterface;

final class JsonModel implements ModelInterface
{
    /** @var string|null */
    private $callbackMethod;
    /** @var array */
    private $data;

    /**
     * @param array $data
     * @param null $callbackMethod
     */
    public function __construct(array $data, $callbackMethod = null)
    {
        $this->callbackMethod = $callbackMethod;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isJSONP()
    {
        return null !== $this->callbackMethod;
    }


    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return null|string
     */
    public function getCallbackMethod()
    {
        return $this->callbackMethod;
    }
}
