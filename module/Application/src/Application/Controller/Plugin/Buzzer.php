<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 23/09/2014
 * Time: 14:14
 */

namespace Application\Controller\Plugin;


use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Buzzer extends AbstractPlugin
{
    protected $sound = 'DINGDINGDING';

    public function __invoke()
    {
        return $this;
    }


    /**
     * @return mixed
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @param mixed $sound
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
    }


} 