<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 24/09/2014
 * Time: 13:23
 */

namespace Application\View\Helper\Table;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\View\Helper\AbstractHelper;

/**
 * Class Table
 * @package Application\View\Helper\Table
 */
class Table extends AbstractHelper implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * @var TableColumnPluginManager
     */
    protected $tableColumnPluginManager;

    /**
     * @var array
     */
    protected $data = [ ];

    /**
     * @var array
     */
    protected $columns = [ ];


    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {

        $this->data = $data;
        return $this;
    }


    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @param $column
     * @return $this
     * @throws Exception
     */
    public function addColumn($column)
    {
        if(is_array($column)) {
            $column = $this->columnFactory($column);
        }
        else {
            if(!$column instanceof Column\AbstractColumn) {
                throw new Exception( 'doit etre une instance de AbstractColumn' );
            }
        }

        $this->columns[] = $column;

        return $this;

    }

    /**
     * @param array $columns
     * @return $this
     */
    public function addColumns(array $columns)
    {
        foreach($columns as $column) {
            $this->addColumn($column);
        }

        return $this;

    }


    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }


    /**
     * @param $columns
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }


    /**
     * @param $options
     * @return mixed
     * @throws Exception
     */
    public function columnFactory($options)
    {
        if(!isset( $options['type'] )) {
            throw new Exception( 'type has to be specified' );
        }


        $column = $this->getTableColumnPluginManager()->get($options['type']);

        unset( $options['type'] );

        $column->setOptions($options);

        return $column;

    }

    /**
     * @return Application\View\Helper\Table\TableColumnPluginManager|TableColumnPluginManager|bool
     * @throws Exception
     */
    public function getTableColumnPluginManager()
    {
        if(is_null($this->tableColumnPluginManager)) {
            $tcpm = $this->getServiceLocator()->getServiceLocator()->get('TableColumnsPluginManager');

            if(!$tcpm instanceof Application\View\Helper\Table\TableColumnPluginManager) {
                throw new Exception( 'impossible de recuperer le PluginManager, ce n\'est pas une instance de Application\View\Helper\Table\TableColumnPluginManager' );
                return false;
            }

            $this->tableColumnPluginManager = $tcpm;
        }

        return $this->tableColumnPluginManager;
    }

    /**
     * @return string
     */
    public function render()
    {


        $output = '<table>';

        $output .= '<thead>';
        $output .= '<tr>';

        foreach($this->columns as $column) {

            $output .= '<th>';

            $output .= $column->getTitle();

            $output .= '</th>';
        }

        $output .= '</tr>';
        $output .= '</thead>';

        $output .= '<tbody>';

        foreach($this->data as $line) {
            $output .= '<tr>';
            foreach($this->columns as $column) {

                $output .= '<td>';
                $output .= $column->render($line);
                $output .= '</td>';

            }
            $output .= '</tr>';
        }

        $output .= '</tbody>';

        $output .= '</table>';

        return $output;

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

}