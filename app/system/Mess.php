<?php
/**
 * Class Mess
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\system;

class Mess
{
    /**
     * @method rend
     *
     * @param string $messer - имена файла и элементов массива
     * @return text/html
     * */
    public static function rend(string $messer = null)
    {
        if ($messer!=null) {
            $mess = explode('.', $messer);
            $result = require 'resource/message/'.$mess[0].'.php';
            return $result[$mess[1]][$mess[2]];
        }
    }
}
