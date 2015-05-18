<?php

namespace Tonis\Json;

use Tonis\View\ViewModelInterface;
use Tonis\View\ViewModelTrait;

final class JsonModel implements ViewModelInterface
{
    use ViewModelTrait;

    /** @var string|null */
    private $callbackMethod;

    /**
     * @return bool
     */
    public function isJsonP()
    {
        return null !== $this->callbackMethod;
    }

    /**
     * @return null|string
     */
    public function getCallbackMethod()
    {
        return $this->callbackMethod;
    }

    /**
     * @param null|string $callbackMethod
     */
    final public function setCallbackMethod($callbackMethod)
    {
        $this->callbackMethod = $callbackMethod;
    }
}
