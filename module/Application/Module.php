<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;


use Application\Service\MailManager\MailListener;
use Zend\EventManager\StaticEventManager;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\ModuleRouteListener;
use Application\Service\UserManager\UserManager;
use Application\Entity\User;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\Event;

class Module implements ServiceProviderInterface, InitProviderInterface
{

    /**
     * Initialize workflow
     *
     * @param  ModuleManagerInterface $manager
     * @return void
     */
    public function init(ModuleManagerInterface $manager)
    {
        $sm = $manager->getEvent()->getParam('ServiceManager');

        $serviceListener =  $sm->get('ServiceListener');

        $serviceListener->addServiceManager(
            'TableColumnsPluginManager',
            'table_columns',
            'Application\View\Helper\Table\Table\TableColumnsProviderInterface',
            ('getTableColumnsConfig')
        );
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        // TODO: Implement getServiceConfig() method.
    }


    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $mailListener = new MailListener();
        $mailListener->attach(
            $e->getApplication()->getServiceManager()
            ->get('application.service.user-manager')
            ->getEventManager()
        );

        StaticEventManager::getInstance()->attach('Application\Entity\User',User::NEW_PROFILE,[$this,'onAddUser']);

    }

    public function onAddUser(Event $e)
    {
        echo 'A new user has just been added ! </br>';
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
