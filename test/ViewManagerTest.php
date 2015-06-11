<?php
namespace Tonis\View;

use Tonis\View\Model\JsonModel;
use Tonis\View\Model\StringModel;
use Tonis\View\Strategy\JsonStrategy;
use Tonis\View\Strategy\StringStrategy;

/**
 * @coversDefaultClass Tonis\View\ViewManager
 */
class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var ViewManager */
    private $vm;

    /**
     * @covers ::__construct
     * @covers ::addStrategy
     * @covers ::getStrategies
     */
    public function testAddStrategy()
    {
        $vm = new ViewManager(new JsonStrategy());
        $vm->addStrategy(new StringStrategy());

        $this->assertCount(1, $vm->getStrategies());
    }

    /**
     * @covers ::setErrorTemplate
     * @covers ::getErrorTemplate
     */
    public function testSetGetErrorTemplate()
    {
        $fallback = new StringStrategy();
        $this->vm->setErrorTemplate($fallback);
        $this->assertSame($fallback, $this->vm->getErrorTemplate());
    }

    /**
     * @covers ::setNotFoundTemplate
     * @covers ::getNotFoundTemplate
     */
    public function testSetGetNotFoundTemplate()
    {
        $fallback = new StringStrategy();
        $this->vm->setNotFoundTemplate($fallback);
        $this->assertSame($fallback, $this->vm->getNotFoundTemplate());
    }

    /**
     * @covers ::render
     */
    public function testRenderWithFallbackStrategy()
    {
        $model = new StringModel('foo');
        $this->assertSame('foo', $this->vm->render($model));
    }

    /**
     * @covers ::render
     */
    public function testRenderWithRegisteredStrategy()
    {
        $model = new JsonModel(['foo']);
        $this->assertSame('["foo"]', $this->vm->render($model));
    }

    protected function setUp()
    {
        $this->vm = new ViewManager(new StringStrategy());
        $this->vm->addStrategy(new JsonStrategy());
    }
}
