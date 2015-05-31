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
    public function render(ViewModelInterface $model, array $variables = [])
    {
        $isJsonP = false;
        if ($model instanceof JsonModel) {
            $variables = array_merge($variables, $model->getVariables());
            $isJsonP = $model->isJsonP();
        }

        $result = json_encode($variables);

        if ($isJsonP) {
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
