<?php
namespace Tonis\View;

use Tonis\View\Model\StringModel;
use Tonis\View\Strategy\JsonStrategy;
use Tonis\View\Strategy\StringStrategy;

/**
 * @coversDefaultClass Tonis\View\Manager
 */
class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var Manager */
    private $vm;

    /**
     * @covers ::addStrategy
     * @covers ::getStrategies
     */
    public function testAddStrategy()
    {
        $this->vm->addStrategy(new JsonStrategy());
        $this->vm->addStrategy(new StringStrategy());

        $this->assertCount(3, $this->vm->getStrategies());
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

    protected function setUp()
    {
        $this->vm = new Manager();
        $this->vm->addStrategy(new StringStrategy());
    }
}
