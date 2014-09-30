<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 24/09/2014
 * Time: 14:54
 */

namespace ApplicationTest\View\Helper\Table\Column;


/**
 * Class AbstractColumnTest
 * @package ApplicationTest\View\Helper\Table\Column
 */
class AbstractColumnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $instance;

    /**
     *
     */
    public function setUp()
    {
        $this->instance = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn');
    }

    /**
     *
     */
    public function tearDown()
    {
        $this->instance = null;
    }

    /**
     *
     */
    public function testGetSetTitle()
    {
        $fixture = 'my title';

        $this->assertSame($this->instance, $this->instance->setTitle($fixture));
        $this->assertSame($fixture, $this->instance->getTitle());
        
    }

    /**
     *
     */
    public function testGetSetValueKey()
    {
        $fixture = 'keyname';

        $this->assertSame($this->instance, $this->instance->setValueKey($fixture));
        $this->assertSame($fixture, $this->instance->getValueKey());

    }

    /**
     *
     */
    public function testSetOptions()
    {
        $fixture = [

          'testValue1' => 'thisisatest',
          'testValue2' => 123

        ];

        $this->instance = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn',
            [], '',true, true, false, ['setTestValue1','setTestValue2']);

        $this->instance->expects($this->once())
            ->method('setTestValue1')
            ->with('thisisatest');

        $this->instance->expects($this->once())
            ->method('setTestValue2')
            ->with(123);

        $this->assertSame($this->instance, $this->instance->setOptions($fixture));


    }

} 