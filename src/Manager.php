<?php
namespace Tonis\View;

use Tonis\View\Exception\UnableToRenderException;

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
            if ($strategy->canRender($model)) {
                $result = $strategy->render($model);
            }

            if (null !== $result) {
                break;
            }
        }

        if (null === $result) {
            throw new UnableToRenderException(
                sprintf(
                    'No strategy available to render model "%s"',
                    get_class($model)
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
}
