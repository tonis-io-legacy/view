<?php

namespace Tonis\View\Twig;

use Tonis\View;
use Tonis\View\ViewModelInterface;
use Tonis\View\ViewResolverInterface;
use Twig_Environment;

final class TwigResolver implements ViewResolverInterface
{
    /** @var Twig_Environment */
    private $twig;
    /** @var string */
    private $suffix;

    /**
     * @param Twig_Environment $twig
     * @param string $suffix
     */
    public function __construct(Twig_Environment $twig, $suffix = '.twig')
    {
        $this->twig = $twig;
        $this->suffix = $suffix;
    }

    /**
     * {@inheritDoc}
     */
    public function resolve($nameOrModel)
    {
        if ($nameOrModel instanceof ViewModelInterface) {
            $nameOrModel = $nameOrModel->getTemplate();
        }
        return $this->twig->loadTemplate($nameOrModel . $this->suffix);
    }
}
