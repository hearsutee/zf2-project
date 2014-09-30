<?php

namespace Application\Service\UserManager;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class UserManagerFactory
 * @package Application\Service\UserManager
 */
class UserManagerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $userManager = new UserManager();

        $user = $serviceLocator->get('application.entity.user');
        $user->setProfile($serviceLocator->get('application.entity.profile'));


        $userManager->setUser($user);

        return $userManager;
    }

}