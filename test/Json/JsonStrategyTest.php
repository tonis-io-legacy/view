<?php

namespace Tonis\View\Json;
use Tonis\View\ViewModel;

/**
 * @coversDefaultClass \Tonis\View\Json\JsonStrategy
 */
class JsonStrategyTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @covers ::canRender
     */
    public function testCanRender()
    {
        $s = new JsonStrategy();
        $this->assertFalse($s->canRender(new ViewModel()));
        $this->assertTrue($s->canRender(new JsonModel()));
    }

    /**
     * @covers ::supportsAliases
     */
    public function testSupportsAliases()
    {
        $s = new JsonStrategy();
        $this->assertSame(false, $s->supportsAliases());
    }

    /**
     * @covers ::convertAlias
     * @expectedException \RuntimeException
     * @expectedExceptionMessage JsonStrategy does not support aliases
     */
    public function testConvertAlias()
    {
        $s = new JsonStrategy();
        $s->convertAlias(null);
    }

    /**
     * @covers ::render
     */
    public function testRenderWithJsonP()
    {
        $s = new JsonStrategy();
        $m = new JsonModel(['foo' => 'bar']);
        $m->setCallbackMethod('foo');
        
        $this->assertSame('foo(' . json_encode(['foo' => 'bar']) . ');', $s->render($m));
    }

    /**
     * @covers ::render
     */
    public function testRender()
    {
        $s = new JsonStrategy();
        $m = new JsonModel(['foo' => 'bar']);

        $this->assertSame(json_encode(['foo' => 'bar']), $s->render($m));
    }
}
