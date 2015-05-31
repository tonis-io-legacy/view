<?php

namespace Tonis\View;

interface StrategyInterface
{
    /**
     * @param ModelInterface $model
     * @return bool
     */
    public function canRender(ModelInterface $model);

    /**
     * @param ModelInterface $model
     * @return string
     */
    public function render(ModelInterface $model);
}
