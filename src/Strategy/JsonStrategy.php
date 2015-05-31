<?php

namespace Tonis\View\Strategy;

use Tonis\View\Model\JsonModel;
use Tonis\View\ModelInterface;
use Tonis\View\StrategyInterface;

final class JsonStrategy implements StrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function canRender(ModelInterface $model)
    {
        return $model instanceof JsonModel;
    }

    /**
     * {@inheritDoc}
     */
    public function render(ModelInterface $model)
    {
        if (!$model instanceof JsonModel) {
            return '{}';
        }

        $result = json_encode($model->getData());

        if ($model->isJSONP()) {
            $result = sprintf('%s(%s);', $model->getCallbackMethod(), $result);
        }

        return $result;
    }
}
