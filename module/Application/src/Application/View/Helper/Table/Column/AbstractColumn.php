<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 24/09/2014
 * Time: 14:54
 */

namespace Application\View\Helper\Table\Column;


/**
 * Class AbstractColumn
 * @package Application\View\Helper\Table\Column
 */
abstract class AbstractColumn
{
    /**
     * @var
     */
    protected $title;
    /**
     * @var
     */
    protected $valueKey;

    /**
     * @param $lines
     * @return string
     */
    abstract public function render($lines);

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValueKey()
    {
        return $this->valueKey;
    }

    /**
     * @param mixed $valueKey
     */
    public function setValueKey($valueKey)
    {
        $this->valueKey = $valueKey;

        return $this;
    }


    /**
     * @param $options
     */
    public function setOptions($options)
    {
        foreach($options as $key => $value){
            $method ='set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }

        return $this;
    }

} 