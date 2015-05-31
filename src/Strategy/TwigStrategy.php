<?php

namespace Tonis\View\Strategy;

use Tonis\View\Model\ViewModel;
use Tonis\View\ModelInterface;
use Tonis\View\StrategyInterface;

final class TwigStrategy implements StrategyInterface
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
    public function render(ModelInterface $model)
    {
        if (!$model instanceof ViewModel) {
            return '';
        }

        return $this->twig->render($model->getTemplate() . $this->suffix, $model->getVariables());
    }

    /**
     * {@inheritDoc}
     */
    public function canRender(ModelInterface $model)
    {
        if (!$model instanceof ViewModel) {
            return false;
        }

        try {
            $this->twig->getLoader()->getSource($model->getTemplate() . $this->suffix);
        } catch (\Twig_Error_Loader $e) {
            return false;
        }
        return true;
    }
}
