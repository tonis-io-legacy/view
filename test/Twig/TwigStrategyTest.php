<?php

namespace Tonis\View\Twig;

use Tonis\View\ViewModel;

/**
 * @coversDefaultClass \Tonis\View\Twig\TwigStrategy
 */
class TwigStrategyTest extends \PHPUnit_Framework_TestCase 
{
    /** @var TwigStrategy */
    private $s;

    /**
     * @covers ::canRender
     */
    public function testCanRender()
    {
        $model = new ViewModel();
        $model->setTemplate('does-not-exist');

        $this->assertFalse($this->s->canRender($model));

        $model->setTemplate('test');
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
     * @expectedExceptionMessage TwigStrategy is compatible with Tonis\View aliases
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
        $m = new ViewModel(['foo' => 'bar']);
        $m->setTemplate('variables');

        $this->assertSame("bar\n", $this->s->render($m));
    }

    protected function setUp()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../_view');
        $twig = new \Twig_Environment($loader);
        $this->s = new TwigStrategy($twig);
    }
}
