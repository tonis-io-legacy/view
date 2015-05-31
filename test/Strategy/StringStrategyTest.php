<?php
namespace Tonis\View\Strategy;

use Tonis\View\Model\StringModel;
use Tonis\View\Model\ViewModel;

/**
 * @coversDefaultClass \Tonis\View\Strategy\StringStrategy
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
        $model = new ViewModel('foo');
        $this->assertFalse($this->s->canRender($model));

        $model = new StringModel('content');
        $this->assertTrue($this->s->canRender($model));
    }

    /**
     * @covers ::render
     */
    public function testRender()
    {
        $m = new StringModel('bar');
        $this->assertSame('bar', $this->s->render($m));
    }

    protected function setUp()
    {
        $this->s = new StringStrategy();
    }
}
