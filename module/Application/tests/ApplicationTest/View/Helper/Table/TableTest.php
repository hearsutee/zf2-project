<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 24/09/2014
 * Time: 13:14
 */

namespace ApplicationTest\View\Helper\Table;

use Application\Test\PhpunitTestCase;
use Application\View\Helper\Table\Table;

/**
 * Class TableTest
 * @package ApplicationTest\View\Helper\Table
 */
class TableTest extends PhpunitTestCase
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
        $this->instance = new Table();
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
    public function testGetSetData()
    {
        $fixture = [
            [1, 2, 3, 4],
            [1, 2, 3, 4],
        ];

        $this->assertSame($this->instance, $this->instance->setData($fixture));
        $this->assertSame($fixture, $this->instance->getData());
    }

    /**
     * tes addColumn from array
     */
    public function testAddColumnFromArray()
    {
        $fixture = [
            'title' => 'col1',
            'valueKey' => 'keyName',
            'type' => 'text'
        ];

        $columnFixture = $this->getMockForAbstractClass(
            'Application\View\Helper\Table\Column\AbstractColumn');


        $this->instance = $this->getMock(
            'Application\View\Helper\Table\Table', ['columnFactory']);


        $this->instance->expects($this->once())
            ->method('columnFactory')
            ->with($fixture)
            ->will($this->returnValue($columnFixture));

        $this->assertSame($this->instance, $this->instance->addColumn($fixture));
        $columns = $this->instance->getColumns();
        $this->assertSame($columnFixture, $columns[0]);
    }

    /**
     * test addColumn from object column
     */
    public function testAddColumnFromColumn()
    {


        $columnFixture = $this->getMockForAbstractClass(
            'Application\View\Helper\Table\Column\AbstractColumn'
        );


        $this->instance = $this->getMock(
            'Application\View\Helper\Table\Table', ['columnFactory']
        );


        $this->instance->expects($this->never())
            ->method('columnFactory');


        $this->assertSame($this->instance, $this->instance->addColumn($columnFixture));
        $columns = $this->instance->getColumns();
        $this->assertSame($columnFixture, $columns[0]);
    }

    /**
     * test addColumn Exception
     */
    public function testAddColumnException()
    {
        $this->setExpectedException('Application\View\Helper\Table\Exception');

        $this->instance->addColumn(new \stdClass());


    }

    /**
     * test columnFactory
     */
    public function testColumnFactory()
    {
        $columnsDataFixtures = [
            'title' => 'col1',
            'valueKey' => 'keyName',
            'type' => 'text'
        ];

        $columnsOptionsFixtures = [
            'title' => 'col1',
            'valueKey' => 'keyName',

        ];

        $columnMock = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn',
            [], '', false, false, false, ['setOptions']);

        $columnMock->expects(($this->once()))
            ->method('setOptions')
            ->with($columnsOptionsFixtures);


        $this->instance->setServiceLocator($this->getViewHelperPlugin(1, 'text', $columnMock));
        $column = $this->instance->columnFactory($columnsDataFixtures);
        $this->assertInstanceOf('Application\View\Helper\Table\Column\AbstractColumn', $column);
    }

    /**
     * test Column Factory Exception
     */
    public function testColumnFactoryException()
    {
        $fixture = [];

        $this->setExpectedException('Application\View\Helper\Table\Exception');

        $this->instance->columnFactory($fixture);


    }

    /**
     * test add columns
     */
    public function testAddColumns()
    {

        $columnsDataFixtures = [
            'title' => 'col1',
            'valueKey' => 'keyName',
            'type' => 'text'
        ];

        $fixture = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn');

        $arrayFixture = [
            $fixture,
            $columnsDataFixtures
        ];

        $this->instance = $this->getMock(
            'Application\View\Helper\Table\Table', ['addColumn']);

        $this->instance->expects($this->exactly(2))
            ->method('addColumn')
            ->with($this->logicalOr(
                    $fixture,
                    $columnsDataFixtures
                )
            );


        $this->assertSame($this->instance, $this->instance->addColumns($arrayFixture));


    }

    /**
     * test render
     */
    public function testRender()
    {


        $columns = [
            [
                'title' => 'col1',
                'valueKey' => 'keyName1',
                'type' => 'text'
            ],
            [
                'title' => 'col2',
                'valueKey' => 'keyName2',
                'type' => 'text'
            ]

        ];

        $dataFixture = [
            ['value 1', 'value 2'],
            ['value 3', 'value 4']
        ];

        $expectedHtml = '
        <table>
    <thead>
        <tr>
        <th>col1</th>
        <th>col2</th>
     </tr>
    </thead>
    <tbody>
    <tr>
        <td>value 1</td>
        <td>value 2</td>
    </tr>
    <tr>
        <td>value 3</td>
        <td>value 4</td>
    </tr>
    </tbody>
</table>
        ';

        $columnMock = $this->getMock(
            'Application\View\Helper\Table\Column\Text', ['getTitle', 'setOptions', 'render']);

        $columnMock->expects($this->exactly(4))
            ->method('render')
            ->will($this->onConsecutiveCalls(
                '>value 1', 'value 2', 'value 3', 'value 4'
            ));

        $this->instance
            ->setServiceLocator($this->getViewHelperPlugin(2, 'text', $columnMock))
            ->setData($dataFixture)
            ->addColumns($columns);

        $renderedElement = new \DOMDocument();
        $renderedElement->loadHtml($this->instance->render());


        $expectedElement = new \DOMDocument();
        $expectedElement->loadHTML($expectedHtml);


        $this->assertEqualXMLStructure(
            $expectedElement->getElementsByTagName('table')->item(0),
            $renderedElement->getElementsByTagName('table')->item(0)
        );


    }

    /**
     * test __toString
     */
    public function testToString()
    {

        $fixture = '<table></table>';

        $this->instance = $this->getMock(
            'Application\View\Helper\Table\Table', ['render']
        );

        $this->instance->expects($this->once())
            ->method('render')
            ->will($this->returnValue($fixture));

        $this->assertSame($fixture, $this->instance->__toString());

    }

    /**
     * test get table columns plugin manager when property is null
     */
    public function testGetTableColumnsPluginManagerWhenIsNull()
    {

        $this->setInaccessiblePropertyValue('tableColumnsPluginManager', null);


        $tableColumnsManagerMock = $this
            ->getMockFromArray('Application\View\Helper\Table\TableColumnsPluginManager', false,
            [

            ]);

        $serviceManagerMock = $this
            ->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
            [
                'get' =>
                    [
                        'with' => 'TableColumnsPluginManager',
                        'will' => $this->returnValue($tableColumnsManagerMock)
                    ]
            ]);

        $viewHelperPluginManagerMock = $this
            ->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
            [
                'getServiceLocator' =>
                    [

                        'will' => $this->returnValue($serviceManagerMock)
                    ]
            ]);


        $this->instance->setServiceLocator($viewHelperPluginManagerMock);
        $this->assertSame($tableColumnsManagerMock, $this->instance->getTableColumnsPluginManager());
//        $this->assertInstanceOf('Application\View\Helper\Table\TableColumnsPluginManager', $this->instance->tableColumnsPluginManager);
    }

    /**
     * test get table columns plugin manager when property is not null
     */
    public function testGetTableColumnsPluginManagerWhenIsNotNull()
    {
        $tableColumnsManagerMock = $this
            ->getMockFromArray('Application\View\Helper\Table\TableColumnsPluginManager', false,
                [

                ]);

        $this->setInaccessiblePropertyValue('tableColumnsPluginManager', $tableColumnsManagerMock);


        $this->assertSame($tableColumnsManagerMock, $this->instance->getTableColumnsPluginManager());
//        $this->assertInstanceOf('Application\View\Helper\Table\TableColumnsPluginManager', $this->instance->tableColumnsPluginManager);
    }

    /**
     * test get table columns plugin manager Exception
     */
    public function testGetTableColumnsPluginManagerException()
    {


        $this->setInaccessiblePropertyValue('tableColumnsPluginManager', new \StdClass());


        $viewHelperPluginManagerMock = $this
            ->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
                [

                ]);

        $this->instance->setServiceLocator($viewHelperPluginManagerMock);

        $this->setExpectedException('Application\View\Helper\Table\Exception');
        $this->instance->getTableColumnsPluginManager();

    }

    /**
     * @param $count
     * @param $type
     * @param $columnMock
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getViewHelperPlugin($count, $type, $columnMock)
    {
//        $tableColumnManagerMock = $this->getMock('Zend\ServiceManager\ServiceManager', ['get'], [], 'TableColumnsPluginManager');
//        $tableColumnManagerMock->expects($this->exactly($count))
//            ->method('get')
//            ->with($type)
//            ->will($this->returnValue($columnMock));
//
//        $serviceManagerMock = $this->getMock('Zend\ServiceManager\ServiceManager', ['get'], [], 'ServiceLocator');
//        $serviceManagerMock->expects($this->once())
//            ->method('get')
//            ->with('TableColumnsPluginManager')
//            ->will($this->returnValue($tableColumnManagerMock));
//
//        $viewHelperPluginManagerMock = $this->getMock('Zend\ServiceManager\ServiceManager', ['getServiceLocator'], [], 'ViewHelperPluginManager');
//        $viewHelperPluginManagerMock->expects($this->once())
//            ->method('getServiceLocator')
//            ->will($this->returnValue($serviceManagerMock));

        $tableColumnManagerMock =$this->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
        [
           'get' =>
           [   'expects' =>$this->exactly($count),
               'with' => $type,
               'will' => $this->returnValue($columnMock)
           ]
        ]);

        $serviceManagerMock =$this->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
        [
            'get' =>
                [
                    'with' => 'TableColumnsPluginManager',
                    'will' => $this->returnValue($tableColumnManagerMock)
                ]
        ]);

        $viewHelperPluginManagerMock =$this->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
        [
            'getServiceLocator' =>
                [

                    'will' => $this->returnValue($serviceManagerMock)
                ]
        ]);

        return $viewHelperPluginManagerMock;
    }




}