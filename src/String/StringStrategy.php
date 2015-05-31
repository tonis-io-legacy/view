<?php

namespace Tonis\View\String;

use Tonis\View\ViewModelInterface;
use Tonis\View\ViewStrategyInterface;

final class StringStrategy implements ViewStrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function render(ViewModelInterface $model)
    {
        $variables = $model->getVariables();

        return isset($variables['content']) ? $variables['content'] : '';
    }

    /**
     * {@inheritDoc}
     */
    public function canRender(ViewModelInterface $model)
    {
        if (!isset($model->getVariables()['content'])) {
            return false;
        }

        return is_string($model->getVariables()['content']);
    }

    /**
     * {@inheritDoc}
     */
    public function supportsAliases()
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function convertAlias($template)
    {
        throw new \RuntimeException('StringStrategy does not support aliases');
    }
}
