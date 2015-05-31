<?php

namespace Tonis\View\Strategy;

use Tonis\View\Model\StringModel;
use Tonis\View\ModelInterface;
use Tonis\View\StrategyInterface;

final class StringStrategy implements StrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function render(ModelInterface $model)
    {
        if (!$model instanceof StringModel) {
            return '';
        }
        return $model->getString();
    }

    /**
     * {@inheritDoc}
     */
    public function canRender(ModelInterface $model)
    {
        return $model instanceof StringModel;
    }
}
