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
    public function render(ViewModelInterface $model)
    {
        return $this->engine->render($model->getTemplate(), $model->getVariables());
    }

    /**
     * {@inheritDoc}
     */
    public function canRender(ViewModelInterface $model)
    {
        return $this->engine->exists($model->getTemplate());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsAliases()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function convertAlias($template)
    {
        if ($template[0] == '@') {
            $template = substr($template, 1);
            $template = preg_replace('@[/]@', '::', $template, 1);
        }
        return $template;
    }
}
