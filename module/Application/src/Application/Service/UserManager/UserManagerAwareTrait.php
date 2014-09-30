<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 23/09/2014
 * Time: 10:38
 */

namespace Application\Service\UserManager;

/**
 * Class UserManagerAwareTrait
 * @package Application\Service\UserManager
 */
trait UserManagerAwareTrait
{
    /**
     * @var Application\UserManager\UserManager
     */
    protected $userManager;

    /**
     * @param UserManager $userManager
     */
    public function setUserManager(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return Application\UserManager\UserManager
     */
    public function getUserManager()
    {
        return $this->userManager ;
    }
} 