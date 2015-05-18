<?php

namespace Tonis\View;

interface ViewRendererInterface
{
    /**
     * @return mixed
     */
    public function getEngine();

    /**
     * @param string|ViewModelInterface $nameOrModel
     * @param null|array $variables
     * @return string
     */
    public function render($nameOrModel, array $variables = []);
}
