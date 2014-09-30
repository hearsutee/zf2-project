<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 24/09/2014
 * Time: 17:02
 */

namespace ApplicationTest\View\Helper\Table\Column;

use Application\View\Helper\Table\Column\Text;

class TextTest extends \PHPUnit_Framework_TestCase
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
        $this->instance = new Text();
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
    public function testRender()
    {
        $fixture = 'Manu';

        $lineFixture = [
            'firstname' => 'Manu',
            'lastname' => 'Lavaud',

        ];

        $this->instance->setValueKey('firstname');

        $this->assertSame($fixture, $this->instance->render($lineFixture));

    }
} 