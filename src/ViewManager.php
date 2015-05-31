<?php
namespace Tonis\View;

final class ViewManager
{
    /** @var string */
    private $errorTemplate = 'error/exception';
    /** @var string */
    private $notFoundTemplate = 'error/404';
    /** @var ViewStrategyInterface */
    private $fallbackStrategy;
    /** @var ViewStrategyInterface[] */
    private $strategies = [];

    /**
     * @param ViewModelInterface $model
     * @return string
     */
    public function render(ViewModelInterface $model)
    {
        $result = null;
        foreach ($this->strategies as $strategy) {
            $result = $this->renderWithStrategy($strategy, $model);

            if ($result instanceof \Exception || null !== $result) {
                break;
            }
        }

        if (null === $result || $result instanceof \Exception) {
            $result = $this->renderWithStrategy($this->fallbackStrategy, $model);

            if (null === $result) {
                throw new \RuntimeException(
                    sprintf(
                        'Unable to render model - template: "%s", variables: "%s"',
                        $model->getTemplate(),
                        var_export(array_keys($model->getVariables()), true)
                    )
                );
            }
        }

        return $result;
    }

    /**
     * @param ViewStrategyInterface $strategy
     */
    public function addStrategy(ViewStrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @return ViewStrategyInterface[]
     */
    public function getStrategies()
    {
        return $this->strategies;
    }

    /**
     * @return ViewStrategyInterface
     */
    public function getFallbackStrategy()
    {
        return $this->fallbackStrategy;
    }

    /**
     * @param ViewStrategyInterface $fallbackStrategy
     */
    public function setFallbackStrategy($fallbackStrategy)
    {
        $this->fallbackStrategy = $fallbackStrategy;
    }

    /**
     * @param string $errorTemplate
     */
    public function setErrorTemplate($errorTemplate)
    {
        $this->errorTemplate = $errorTemplate;
    }

    /**
     * @return string
     */
    public function getErrorTemplate()
    {
        return $this->errorTemplate;
    }

    /**
     * @param string $notFoundTemplate
     */
    public function setNotFoundTemplate($notFoundTemplate)
    {
        $this->notFoundTemplate = $notFoundTemplate;
    }

    /**
     * @return string
     */
    public function getNotFoundTemplate()
    {
        return $this->notFoundTemplate;
    }

    /**
     * @param ViewStrategyInterface $strategy
     * @param ViewModelInterface $model
     * @return bool|string
     */
    private function renderWithStrategy(ViewStrategyInterface $strategy, ViewModelInterface $model)
    {
        if ($strategy->supportsAliases()) {
            $model = clone $model;
            $model->setTemplate($strategy->convertAlias($model->getTemplate()));
        }

        if (!$strategy->canRender($model)) {
            return null;
        }

        try {
            return $strategy->render($model);
        } catch (\Exception $ex) {
            return $ex;
        }
    }
}
