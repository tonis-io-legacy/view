<?php

namespace Tonis\View\Twig;

use Tonis\View;
use Tonis\View\ViewModelInterface;
use Tonis\View\ViewStrategyInterface;

final class TwigStrategy implements ViewStrategyInterface
{
    /** \Tonis\ViewRendererInterface */
    private $renderer;
    /** @var \Tonis\View\ViewResolverInterface */
    private $resolver;

    /**
     * @param \Tonis\View\Twig\TwigRenderer $renderer
     * @param \Tonis\View\Twig\TwigResolver $resolver
     */
    public function __construct(TwigRenderer $renderer, TwigResolver $resolver)
    {
        $this->renderer = $renderer;
        $this->resolver = $resolver;
    }

    /**
     * {@inheritDoc}
     */
    public function render($nameOrModel, array $variables = [])
    {
        return $this->renderer->render($nameOrModel, $variables);
    }

    /**
     * {@inheritDoc}
     */
    public function canRender($nameOrModel)
    {
        if (!$nameOrModel instanceof ViewModelInterface) {
            return false;
        }

        try {
            $this->resolver->resolve($nameOrModel);
        } catch (\Twig_Error_Loader $e) {
            return false;
        }
        return true;
    }
}
