<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 25/09/2014
 * Time: 17:31
 */

namespace Application\View\Helper\Table;



use Application\View\Helper\Table\Column\AbstractColumn;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception as MainException;

class TableColumnsPluginManager extends AbstractPluginManager
{
    protected $shareByDefault = false ;

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if(!$plugin instanceof AbstractColumn){
            throw new MainException('This manager must only return an instance of AbstractColumn');
        }


    }


} 