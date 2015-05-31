<?php

namespace Tonis\View\String;

use Tonis\View\ViewModel;

/**
 * @coversDefaultClass \Tonis\View\String\StringStrategy
 */
class StringStrategyTest extends \PHPUnit_Framework_TestCase 
{
    /** @var StringStrategy */
    private $s;

    /**
     * @covers ::canRender
     */
    public function testCanRender()
    {
        $model = new ViewModel();

        $this->assertFalse($this->s->canRender($model));

        $model->setVariables(['content' => 'test']);
        $this->assertTrue($this->s->canRender($model));
    }

    /**
     * @covers ::supportsAliases
     */
    public function testSupportsAliases()
    {
        $this->assertSame(false, $this->s->supportsAliases());
    }

    /**
     * @covers ::convertAlias
     * @expectedException \RuntimeException
     * @expectedExceptionMessage StringStrategy does not support aliases
     */
    public function testConvertAlias()
    {
        $this->assertSame('test::some/path', $this->s->convertAlias('@test/some/path'));
    }

    /**
     * @covers ::render
     */
    public function testRender()
    {
        $m = new ViewModel(['content' => 'bar']);

        $this->assertSame('bar', $this->s->render($m));
    }

    protected function setUp()
    {
        $this->s = new StringStrategy();
    }
}
