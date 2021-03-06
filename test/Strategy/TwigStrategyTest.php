<?php
namespace Tonis\View\Strategy;

use Tonis\View\Model\JsonModel;
use Tonis\View\Model\ViewModel;

/**
 * @coversDefaultClass \Tonis\View\Strategy\TwigStrategy
 */
class TwigStrategyTest extends \PHPUnit_Framework_TestCase 
{
    /** @var TwigStrategy */
    private $s;

    /**
     * @covers ::getTwig
     */
    public function testGetTwig()
    {
        $this->assertInstanceOf(\Twig_Environment::class, $this->s->getTwig());
    }

    /**
     * @covers ::canRender
     */
    public function testCanRender()
    {
        $model = new JsonModel([]);
        $this->assertFalse($this->s->canRender($model));

        $model = new ViewModel('does-not-exist');
        $this->assertFalse($this->s->canRender($model));

        $model = new ViewModel('test');
        $this->assertTrue($this->s->canRender($model));
    }

    /**
     * @covers ::render
     */
    public function testRenderWithInvalidModel()
    {
        $this->assertSame('', $this->s->render(new JsonModel([])));
    }

    /**
     * @covers ::__construct
     * @covers ::render
     */
    public function testRender()
    {
        $m = new ViewModel('variables', ['foo' => 'bar']);
        $this->assertSame("bar\n", $this->s->render($m));
    }

    protected function setUp()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../_view');
        $twig = new \Twig_Environment($loader);
        $this->s = new TwigStrategy($twig);
    }
}
