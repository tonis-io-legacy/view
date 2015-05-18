<?php

namespace Tonis\View\Twig;

use Tonis;
use Tonis\View\ViewModel;
use Tonis\View\ViewModelInterface;
use Tonis\View\ViewRendererInterface;

final class TwigRenderer implements ViewRendererInterface
{
    /** @var TwigResolver */
    private $resolver;
    /** @var \Twig_Environment */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     * @param TwigResolver $resolver
     */
    public function __construct(\Twig_Environment $twig, TwigResolver $resolver)
    {
        $this->twig = $twig;
        $this->resolver = $resolver;
    }

    /**
     * {@inheritDoc}
     */
    public function getEngine()
    {
        return $this->twig;
    }

    /**
     * {@inheritDoc}
     */
    public function render($nameOrModel, array $variables = [])
    {
        if (!$nameOrModel instanceof ViewModelInterface) {
            $model = new ViewModel();
            $model->setVariables($variables);
            $model->setTemplate($nameOrModel);

            $nameOrModel = $model;
        }

        return $this
            ->resolver
            ->resolve($nameOrModel)
            ->render($nameOrModel->getVariables());
    }
}
