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
     * @param ViewStrategyInterface $strategy
     */
    public function addStrategy(ViewStrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @param ViewModelInterface $model
     * @return string
     */
    public function render(ViewModelInterface $model)
    {
        $result = null;
        foreach ($this->strategies as $strategy) {
            if (!$strategy->canRender($model)) {
                continue;
            }

            $result = $this->renderWithStrategy($strategy, $model);

            if ($result instanceof \Exception) {
                break;
            }
        }

        if (null === $result || $result instanceof \Exception) {
            $result = $this->renderWithStrategy($this->fallbackStrategy, $model);
        }

        return $result;
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
     * @return ViewStrategyInterface[]
     */
    public function getStrategies()
    {
        return $this->strategies;
    }

    /**
     * @param ViewStrategyInterface $strategy
     * @param ViewModelInterface $model
     * @return bool|string
     */
    private function renderWithStrategy(ViewStrategyInterface $strategy, ViewModelInterface $model)
    {
        try {
            return $strategy->render($model);
        } catch (\Exception $ex) {
            return $ex;
        }
    }
}
