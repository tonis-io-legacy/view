<?php
namespace Tonis\View\Strategy;

use League\Plates\Engine;
use Tonis\View\Model\StringModel;
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
        $model = new StringModel('test');
        $this->assertFalse($this->s->canRender($model));

        $model = new ViewModel('does-not-exist');
        $this->assertFalse($this->s->canRender($model));

        $model = new ViewModel('test');
        $this->assertTrue($this->s->canRender($model));
    }

    /**
     * @covers ::render
     * @covers ::convertTemplate
     */
    public function testRenderWithInvalidModel()
    {
        $this->assertSame('', $this->s->render(new StringModel('')));
    }

    /**
     * @covers ::render
     * @covers ::convertTemplate
     */
    public function testRenderConvertsAliases()
    {
        $model = new ViewModel('@test/test');
        $this->assertSame("Template success!\n", $this->s->render($model));
    }

    /**
     * @covers ::__construct
     * @covers ::render
     * @covers ::convertTemplate
     */
    public function testRender()
    {
        $m = new ViewModel('variables', ['foo' => 'bar']);
        $this->assertSame('bar', $this->s->render($m));
    }

    protected function setUp()
    {
        $engine = new Engine(__DIR__ . '/../_view');
        $engine->addFolder('test', __DIR__ . '/../_view');

        $this->s = new PlatesStrategy($engine);
    }
}
