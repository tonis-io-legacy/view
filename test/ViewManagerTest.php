<?php
namespace Tonis\View;

use Tonis\View\Model\StringModel;
use Tonis\View\Model\ViewModel;
use Tonis\View\Strategy\JsonStrategy;
use Tonis\View\Strategy\StringStrategy;
use Tonis\View\TestAsset\ExceptionStrategy;

/**
 * @coversDefaultClass Tonis\View\ViewManager
 */
class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var ViewManager */
    private $vm;

    /**
     * @covers ::addStrategy
     * @covers ::getStrategies
     */
    public function testAddStrategy()
    {
        $vm = new ViewManager();
        $vm->addStrategy(new JsonStrategy());
        $vm->addStrategy(new StringStrategy());

        $this->assertCount(2, $vm->getStrategies());
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
    public function testRender()
    {
        $model = new StringModel('foo');
        $this->assertSame('foo', $this->vm->render($model));
    }

    /**
     * @covers ::render
     * @expectedException \Tonis\View\Exception\UnableToRenderException
     * @expectedExceptionMessage No strategy available to render model "Tonis\View\Model\ViewModel"
     */
    public function testRenderWithNoResult()
    {
        $this->vm->render(new ViewModel('foo'));
    }

    protected function setUp()
    {
        $this->vm = new ViewManager();
        $this->vm->addStrategy(new JsonStrategy());
        $this->vm->addStrategy(new StringStrategy());
    }
}
