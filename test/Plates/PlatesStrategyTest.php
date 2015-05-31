<?php

namespace Tonis\View\Plates;

use League\Plates\Engine;
use Tonis\View\ViewModel;

/**
 * @coversDefaultClass \Tonis\View\Plates\PlatesStrategy
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
        $this->assertSame(true, $this->s->supportsAliases());
    }

    /**
     * @covers ::convertAlias
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

        $this->assertSame('bar', $this->s->render($m));
    }

    protected function setUp()
    {
        $this->s = new PlatesStrategy(new Engine(__DIR__ . '/../_view'));
    }
}
