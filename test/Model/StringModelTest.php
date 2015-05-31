<?php
namespace Tonis\View\Model;

/**
 * @coversDefaultClass \Tonis\View\Model\StringModel
 */
class StringModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getString
     */
    public function testGetString()
    {
        $string = 'foo';

        $m = new StringModel($string);
        $this->assertSame($string, $m->getString());
    }
}
