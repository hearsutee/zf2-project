<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 22/09/2014
 * Time: 17:29
 */

namespace Application\Entity;


use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityAbstractFactory implements AbstractFactoryInterface
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
        return substr($requestedName,0,strlen('application.entity.')) == 'application.entity.' ;
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
        $nameExploded = explode('.',$requestedName);
        $className = 'Application\\Entity\\'. ucfirst($nameExploded[count($nameExploded)-1]);

        $entity = new $className;
        return $entity;

    }



}


