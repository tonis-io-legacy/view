<?php
namespace Tonis\View;
use Tonis\View\Json\JsonStrategy;
use Tonis\View\String\StringStrategy;

/**
 * @coversDefaultClass Tonis\View\ViewManager
 */
class ViewManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var ViewManager */
    private $vm;

    /**
     * @covers ::addStrategy
     * @covers ::getStrategies
     */
    public function testAddStrategy()
    {
        $this->vm->addStrategy(new JsonStrategy());
        $this->vm->addStrategy(new StringStrategy());

        $this->assertCount(2, $this->vm->getStrategies());
    }

    /**
     * @covers ::setFallbackStrategy
     * @covers ::getFallbackStrategy
     */
    public function testSetGetFallbackStrategy()
    {
        $fallback = new StringStrategy();
        $this->vm->setFallbackStrategy($fallback);
        $this->assertSame($fallback, $this->vm->getFallbackStrategy());
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

    }

    protected function setUp()
    {
        $this->vm = new ViewManager();
    }
}
