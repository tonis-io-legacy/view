<?php

namespace Tonis\View;

/**
 * @coversDefaultClass \Tonis\View\ViewModelTrait
 */
class ViewModelTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     */
    public function testVarsSetOnConstruction()
    {
        $vars = ['foo' => 'bar', 'baz' => 'boo'];
        $model = new ViewModel($vars);
        $this->assertSame($vars, $model->getVariables());
    }

    /**
     * @covers ::getTemplate
     * @covers ::setTemplate
     */
    public function testGetSetTemplate()
    {
        $template = 'foo';
        $model = new ViewModel();
        $model->setTemplate($template);

        $this->assertSame($template, $model->getTemplate());
    }

    /**
     * @covers ::getVariables
     * @covers ::setVariables
     */
    public function testGetSetVariables()
    {
        $variables = ['foo' => 'bar'];
        $model = new ViewModel();
        $model->setVariables($variables);

        $this->assertSame($variables, $model->getVariables());
    }

    /**
     * @covers ::getOptions
     * @covers ::setOptions
     */
    public function testGetSetOptions()
    {
        $options = ['foo' => 'bar'];
        $model = new ViewModel();
        $model->setOptions($options);

        $this->assertSame($options, $model->getOptions());
    }
}
