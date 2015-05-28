<?php

namespace Tonis\View\Twig;

use Tonis\View\ViewModelInterface;
use Tonis\View\ViewStrategyInterface;

final class TwigStrategy implements ViewStrategyInterface
{
    /** @var \Twig_Environment */
    private $twig;
    /** @var string */
    private $suffix;

    /**
     * @param \Twig_Environment $twig
     * @param string $suffix
     */
    public function __construct(\Twig_Environment $twig, $suffix = '.twig')
    {
        $this->suffix = $suffix;
        $this->twig = $twig;
    }

    /**
     * {@inheritDoc}
     */
    public function render(ViewModelInterface $model)
    {
        return $this->twig->render($model->getTemplate() . $this->suffix, $model->getVariables());
    }

    /**
     * {@inheritDoc}
     */
    public function canRender(ViewModelInterface $model)
    {
        try {
            $this->twig->getLoader()->getSource($model->getTemplate() . $this->suffix);
        } catch (\Twig_Error_Loader $e) {
            return false;
        }
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsAliases()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function convertAlias($template)
    {
        return $template;
    }
}
