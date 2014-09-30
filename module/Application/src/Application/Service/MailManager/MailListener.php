<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 24/09/2014
 * Time: 10:35
 */

namespace Application\Service\MailManager;


use Application\Service\UserManager\UserManager;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

class MailListener implements ListenerAggregateInterface
{

    protected $listeners = array();

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] =$events->attach(UserManager::ADD_USER, [$this,'onAddUser']);
    }


    /**
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $callback) {
            if ($events->detach($callback)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onAddUser(Event $e)
    {
        echo 'sending email to' .$e->getParam('firstname').' '.$e->getParam('lastname');
    }


} 