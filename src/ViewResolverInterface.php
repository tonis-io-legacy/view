<?php

namespace Tonis\View;

interface ViewResolverInterface
{
    /**
     * @param ViewModelInterface|string $nameOrModel
     * @return bool
     */
    public function resolve($nameOrModel);
}
