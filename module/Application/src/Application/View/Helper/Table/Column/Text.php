<?php
/**
 * Created by PhpStorm.
 * User: emmanuellavaud
 * Date: 24/09/2014
 * Time: 17:02
 */

namespace Application\View\Helper\Table\Column;


class Text extends AbstractColumn
{
    /**
     * @param $lines
     * @return string
     */
    public function render($lines)
    {
       return
           //'<td>'.
       $lines[$this->valueKey]
//       .'</td>'
           ;
    }

} 