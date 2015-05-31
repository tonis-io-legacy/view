<?php
 
namespace Tonis\View\Json;

/**
 * @coversDefaultClass \Tonis\View\Json\JsonModel
 */
class JsonModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::isJsonP
     * @covers ::setCallbackMethod
     * @covers ::getCallbackMethod
     */
    public function testIsJsonP()
    {
        $m = new JsonModel();
        $this->assertFalse($m->isJsonP());
        
        $m->setCallbackMethod('foo');
        
        $this->assertTrue($m->isJsonP());
        $this->assertSame('foo', $m->getCallbackMethod());
    }
}
