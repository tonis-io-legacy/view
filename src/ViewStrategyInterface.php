<?php

namespace Tonis\View;

interface ViewStrategyInterface
{
    /**
     * @param ViewModelInterface $model
     * @return bool
     */
    public function canRender(ViewModelInterface $model);

    /**
     * @param ViewModelInterface $model
     * @return string
     */
    public function render(ViewModelInterface $model);

    /**
     * @return bool
     */
    public function supportsAliases();

    /**
     * Converts the "@folder/template" syntax to the equivalent in the
     * renderer for the strategy.
     *
     * e.g.,
     *   With PlatesPHP the @error/404 template gets converted to error::404.
     *   With Twig, the @error/404 syntax is equivalent and is not touched.
     *
     * @param string $template
     * @return string
     */
    public function convertAlias($template);
}
