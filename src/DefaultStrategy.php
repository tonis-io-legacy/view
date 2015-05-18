<?php

namespace Tonis\View;

final class DefaultStrategy implements ViewStrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function canRender($nameOrModel)
    {
        return true;
    }

    /**
     * @param ViewModelInterface|string $nameOrModel
     * @param array $variables
     * @return string
     */
    public function render($nameOrModel, array $variables = [])
    {
        return var_export($nameOrModel, true);
    }
}
