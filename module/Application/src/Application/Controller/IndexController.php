<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController@
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $configToto = $this->getServiceLocator()->get('config.toto');
        $configTiti = $this->getServiceLocator()->get('config.titi');

        return new ViewModel(
            array(
                'configToto' => $configToto ,
                'configTiti' => $configTiti ,
            )
        );
    }

    /**
     * @return ViewModel
     */
    public function servicesAction()
    {
        $configToto = $this->getServiceLocator()->get('config.toto');
        $configTiti = $this->getServiceLocator()->get('config.titi');

        $user1 = $this->getServiceLocator()->get('application.entity.user');
        $user2 = $this->getServiceLocator()->get('application.entity.user');

        $userManager = $this->getServiceLocator()->get('application.service.user-manager');
        $userManager->addUser('Manu','Lavaud');


        $mailManager = $this->getServiceLocator()->get('application.service.mail-manager');

        return new ViewModel(
            array(
                'configToto' => $configToto ,
                'configTiti' => $configTiti ,
                'user1' => $user1,
                'user2' => $user2,
                'userManager' => $userManager,
                'mailManager' => $mailManager,

            )
        );
    }

    /**
     * @return ViewModel
     */
    public function buzzerAction()
    {
        $buzzer = $this->buzzer()->getSound();

        return new ViewModel(
            array(
                'myBuzzer' => $buzzer ,

            )
        );
    }
}
