<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 25/09/2014
 * Time: 17:29
 */

namespace Application\View\Helper\Table;


use Zend\Mvc\Service\AbstractPluginManagerFactory;

class TableColumnsManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'Application\View\Helper\Table\TableColumnsPluginManager';
} 