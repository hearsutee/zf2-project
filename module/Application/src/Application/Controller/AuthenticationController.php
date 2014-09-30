<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 23/09/2014
 * Time: 15:58
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class AuthenticationController
 * @package Application\Controller
 */
class AuthenticationController extends AbstractActionController
{
    public function loginAction() {
        $column =
            [
                ['type' => 'text', 'title' => 'id'       , 'valueKey' => 'id'],
                ['type' => 'text', 'title' => 'firstname', 'valueKey' => 'firstname'],
                ['type' => 'text', 'title' => 'lastname' , 'valueKey' => 'lastname'],
                ['type' => 'text', 'title' => 'age'      , 'valueKey' => 'age'],
//                ['type' => 'progressBar', 'title' => '-'      , 'valueKey' => 'age', 'color' => 'red'],
            ];

        $userData =
            [
                ['id' => 1, 'firstname' => 'Manu', 'lastname' => 'Lavaud', 'age' => 47],
                ['id' => 2, 'firstname' => 'grgr', 'lastname' => 'Schmitz', 'age' => 24],
                ['id' => 3, 'firstname' => 'rgererg', 'lastname' => 'ergerg', 'age' => 57],
                ['id' => 4, 'firstname' => 'rgrgrg', 'lastname' => 'AFEZrf', 'age' => 89],
            ];
        //$TableColumnsPluginManager = $this->getServiceLocator('TableColumnsPluginManager');

        return new ViewModel(
            [
                'column' => $column,
                'userData' => $userData
            ]);
    }


} 