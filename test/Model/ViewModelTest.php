<?php
namespace Tonis\View\Model;

/**
 * @coversDefaultClass \Tonis\View\Model\ViewModel
 */
class ViewModelTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     */
    public function testVarsSetOnConstruction()
    {
        $vars = ['foo' => 'bar', 'baz' => 'boo'];
        $model = new ViewModel('template', $vars);
        $this->assertSame($vars, $model->getVariables());
    }

    /**
     * @covers ::getTemplate
     */
    public function testGetTemplate()
    {
        $template = 'foo';
        $model = new ViewModel($template);

        $this->assertSame($template, $model->getTemplate());
    }

    /**
     * @covers ::getVariables
     */
    public function testGetVariables()
    {
        $variables = ['foo' => 'bar'];
        $model = new ViewModel('foo', $variables);

        $this->assertSame($variables, $model->getVariables());
    }
}
