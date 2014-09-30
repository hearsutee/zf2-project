<?php

namespace Application\Entity;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

/**
 * Class User
 * @package Application\Entity
 */
class User implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    const NEW_PROFILE = 'new-profile';

    protected $profile;

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {

        $this->getEventManager()->trigger(self::NEW_PROFILE, $this,
            [
                'adress' => '3 rue des fleurs'
            ]
        );

        $this->profile = $profile;
        return $this;
    }



}