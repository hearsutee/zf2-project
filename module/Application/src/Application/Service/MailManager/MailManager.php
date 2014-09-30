<?php


namespace Application\Service\MailManager;
use Application\Service\UserManager\UserManagerAwareInterface;
use Application\Service\UserManager\UserManagerAwareTrait;

/**
 * Class MailManager
 * @package Application\Service
 */
class MailManager implements UserManagerAwareInterface
{

    use UserManagerAwareTrait;

} 