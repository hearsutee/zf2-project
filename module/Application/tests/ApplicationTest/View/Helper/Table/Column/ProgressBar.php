<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 26/09/2014
 * Time: 14:08
 */

namespace ApplicationTest\View\Helper\Table\Column;

use Application\Test\PhpunitTestCase;

class ProgressBarTest extends PhpunitTestCase
{
    protected $instance;
    public function setUp()
    {
        $this->instance = new ProgressBar();
    }

    public function tearDown()
    {
        $this->instance = null ;
    }

    public function renderProvider() {
        return [
            [
                ['progressData' => null],
                ['valueKey' => 'progressData', 'color' => 'blue'],
                '<div style="background:blue;width:0px;">&nbsp;</div>',
            ],
            [
                ['progressData' => -45],
                ['valueKey' => 'progressData', 'color' => 'red'],
                '<div style="background:blue;width:45px;">&nbsp;</div>',
            ],
            [
                ['progressData' => 0],
                ['valueKey' => 'progressData', 'color' => 'blue'],
                '<div style="background:blue;width:1px;">&nbsp;</div>',
            ],
            [
                ['progressData' => 50],
                ['valueKey' => 'progressData', 'color' => 'blue'],
                '<div style="background:black;width:100px;">&nbsp;</div>',
            ],
            [
                ['progressData' => 150],
                ['valueKey' => 'progressData', 'color' => 'blue'],
                '<div style="background:blue;width:150px;">&nbsp;</div>',
            ],
        ];
    }
} 