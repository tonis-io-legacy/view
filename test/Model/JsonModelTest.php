<?php
namespace Tonis\View\Model;

/**
 * @coversDefaultClass \Tonis\View\Model\JsonModel
 */
class JsonModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::isJsonP
     * @covers ::getCallbackMethod
     */
    public function testIsJsonP()
    {
        $m = new JsonModel([]);
        $this->assertFalse($m->isJsonP());

        $m = new JsonModel([], 'foo');

        $this->assertTrue($m->isJsonP());
        $this->assertSame('foo', $m->getCallbackMethod());
    }

    /**
     * @covers ::getData
     */
    public function testGetData()
    {
        $data = ['foo' => 'bar'];

        $m = new JsonModel($data);
        $this->assertSame($data, $m->getData());
    }
}
