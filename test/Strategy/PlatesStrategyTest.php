<?php
namespace Tonis\View\Strategy;

use League\Plates\Engine;
use Tonis\View\Model\ViewModel;

/**
 * @coversDefaultClass \Tonis\View\Strategy\PlatesStrategy
 */
class PlatesStrategyTest extends \PHPUnit_Framework_TestCase 
{
    /** @var PlatesStrategy */
    private $s;

    /**
     * @covers ::canRender
     */
    public function testCanRender()
    {
        $model = new ViewModel('does-not-exist');
        $this->assertFalse($this->s->canRender($model));

        $model = new ViewModel('test');
        $this->assertTrue($this->s->canRender($model));
    }

    /**
     * @covers ::__construct
     * @covers ::render
     */
    public function testRender()
    {
        $m = new ViewModel('variables', ['foo' => 'bar']);

        $this->assertSame('bar', $this->s->render($m));
    }

    protected function setUp()
    {
        $this->s = new PlatesStrategy(new Engine(__DIR__ . '/../_view'));
    }
}
