<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 23/09/2014
 * Time: 10:45
 */

namespace Application\Service\UserManager;


use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class UserManagerInitializer
 * @package Application\Service\UserManager
 */
class UserManagerInitializer implements InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if(method_exists($instance, 'setUserManager')){

            $instance->setUserManager($serviceLocator->get('application.service.user-manager'));

        }

    }

} 