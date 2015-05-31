<?php
namespace Tonis\View;

final class Manager
{
    /** @var string */
    private $errorTemplate = 'error/exception';
    /** @var string */
    private $notFoundTemplate = 'error/404';
    /** @var StrategyInterface[] */
    private $strategies = [];

    /**
     * @param ModelInterface $model
     * @return string
     */
    public function render(ModelInterface $model)
    {
        $result = null;
        foreach ($this->strategies as $strategy) {
            $result = $this->renderWithStrategy($strategy, $model);

            if (null !== $result) {
                break;
            }
        }

        if (null === $result || $result instanceof \Exception) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to render model: "%s"',
                    var_export($model, true)
                )
            );
        }

        return $result;
    }

    /**
     * @param StrategyInterface $strategy
     */
    public function addStrategy(StrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @return StrategyInterface[]
     */
    public function getStrategies()
    {
        return $this->strategies;
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
     * @param StrategyInterface $strategy
     * @param ModelInterface $model
     * @return bool|string
     */
    private function renderWithStrategy(StrategyInterface $strategy, ModelInterface $model)
    {
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
