<?php

namespace Tonis\View;

interface ViewStrategyInterface
{
    /**
     * @param ViewModelInterface|string $nameOrModel
     * @return bool
     */
    public function canRender($nameOrModel);

    /**
     * @param ViewModelInterface|string $nameOrModel
     * @param array $variables
     * @return string
     */
    public function render($nameOrModel, array $variables = []);
}
