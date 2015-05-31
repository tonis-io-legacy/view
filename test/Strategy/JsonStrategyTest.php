<?php
namespace Tonis\View\Strategy;

use Tonis\View\Model\StringModel;
use Tonis\View\Model\ViewModel;
use Tonis\View\Model\JsonModel;

/**
 * @coversDefaultClass \Tonis\View\Strategy\JsonStrategy
 */
class JsonStrategyTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @covers ::canRender
     */
    public function testCanRender()
    {
        $s = new JsonStrategy();
        $this->assertFalse($s->canRender(new ViewModel('foo')));
        $this->assertTrue($s->canRender(new JsonModel([])));
    }

    /**
     * @covers ::render
     */
    public function testRenderWithInvalidModel()
    {
        $s = new JsonStrategy();
        $this->assertSame('{}', $s->render(new StringModel('')));
    }

    /**
     * @covers ::render
     */
    public function testRenderWithJsonP()
    {
        $s = new JsonStrategy();
        $m = new JsonModel(['foo' => 'bar'], 'foo');

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
