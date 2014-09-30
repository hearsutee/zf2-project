<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 23/09/2014
 * Time: 10:29
 */

namespace Application\Service\UserManager;

/**
 * Interface UserManagerAwareInterface
 * @package Application\Service\UserManager
 */
interface UserManagerAwareInterface
{
    /**
     * @param UserManager $user
     * @return mixed
     */
    public function setUserManager(UserManager $user);

    /**
     * @return mixed
     */
    public function getUserManager();

} 