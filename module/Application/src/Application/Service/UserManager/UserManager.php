<?php

namespace Application\Service\UserManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

/**
 * Class UserManager
 * @package Application\Service
 */
class UserManager implements EventManagerAwareInterface
{

    use EventManagerAwareTrait;

    const ADD_USER = 'add-user';

    /**
     * @var Application\Entity\User
     */
    protected $user;

    /**
     * @return Application\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Application\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }


    public function addUser($firstname, $lastname)
    {

        $this->getEventManager()->trigger(self::ADD_USER, $this,
            [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ]
        );

        return $this;


    }



}