<?php

namespace Tonis\View\Strategy;

use League\Plates\Engine;
use Tonis\View\Model\ViewModel;
use Tonis\View\ModelInterface;
use Tonis\View\StrategyInterface;

final class PlatesStrategy implements StrategyInterface
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
    public function render(ModelInterface $model)
    {
        if (!$model instanceof ViewModel) {
            return '';
        }

        $template = $model->getTemplate();
        if ($template[0] == '@') {
            $template = substr($template, 1);
            $template = preg_replace('@[/]@', '::', $template, 1);
        }

        return $this->engine->render($template, $model->getVariables());
    }

    /**
     * {@inheritDoc}
     */
    public function canRender(ModelInterface $model)
    {
        if (!$model instanceof ViewModel) {
            return false;
        }
        return $this->engine->exists($model->getTemplate());
    }
}