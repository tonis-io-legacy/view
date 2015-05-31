<?php
namespace Tonis\View\Model;

use Tonis\View\ModelInterface;

final class ViewModel implements ModelInterface
{
    /** @var string */
    private $template;
    /** @var array */
    private $variables = [];

    /**
     * @param string $template
     * @param array $variables
     */
    public function __construct($template, array $variables = [])
    {
        $this->template = $template;
        $this->variables = $variables;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }
}
