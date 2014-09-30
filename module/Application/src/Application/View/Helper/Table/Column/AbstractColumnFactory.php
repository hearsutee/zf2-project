<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 25/09/2014
 * Time: 17:36
 */

namespace Application\View\Helper\Table\Column;


use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractColumnFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {

        return in_array($requestedName,
            [
                'text', 'number', 'progressBar'
            ]
            );
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
       $className= 'Application\\View\\Helper\\Table\\Column\\' . ucfirst($requestedName);

        return new $className;
    }


} 