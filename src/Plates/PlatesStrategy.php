<?php

namespace Tonis\View\Plates;

use League\Plates\Engine;
use Tonis\View;
use Tonis\View\ViewModelInterface;
use Tonis\View\ViewStrategyInterface;

final class PlatesStrategy implements ViewStrategyInterface
{
    /** @var Engine */
    private $engine;

    /**
     * @param Engine $plates
     */
    public function __construct(Engine $plates)
    {
        $this->engine = $plates;
    }

    /**
     * {@inheritDoc}
     */
    public function render($nameOrModel, array $variables = [])
    {
        return $this->engine->render($nameOrModel->getTemplate(), $variables);
    }

    /**
     * {@inheritDoc}
     */
    public function canRender($nameOrModel)
    {
        if (!$nameOrModel instanceof ViewModelInterface) {
            return false;
        }
        return $this->engine->exists($nameOrModel->getTemplate());
    }
}
