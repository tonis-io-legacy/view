<?php

namespace Tonis\View\Twig;

use Tonis\View;
use Tonis\View\ViewModel;
use Tonis\View\ViewModelInterface;
use Tonis\View\ViewStrategyInterface;

final class TwigStrategy implements ViewStrategyInterface
{
    /** @var \Twig_Environment */
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
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

        return $this->twig->render($nameOrModel->getTemplate() . '.twig', $nameOrModel->getVariables());
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
            $this->twig->loadTemplate($nameOrModel->getTemplate() . '.twig');
        } catch (\Twig_Error_Loader $e) {
            return false;
        }
        return true;
    }
}
