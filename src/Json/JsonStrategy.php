<?php

namespace Tonis\View\Json;

use Tonis\View\ViewModelInterface;
use Tonis\View\ViewStrategyInterface;

final class JsonStrategy implements ViewStrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function canRender(ViewModelInterface $model)
    {
        return $model instanceof JsonModel;
    }

    /**
     * {@inheritDoc}
     */
    public function render(ViewModelInterface $model)
    {
        $result = json_encode($model->getVariables());

        if ($model instanceof JsonModel && $model->isJsonP()) {
            $result = sprintf('%s(%s);', $model->getCallbackMethod(), $result);
        }

        return $result;
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
        throw new \RuntimeException('JsonStrategy does not support aliases');
    }
}
