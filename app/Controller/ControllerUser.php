<?php
/**
 * Class ControllerUser
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\Controller;

use App\system\Controller;
use App\system\View;

class ControllerUser extends Controller
{
    /**
     * @var string Название HTML шаблона (resource/Wiew/template)
     * */
    public $template = 'mytemplate';
    
    /**
     * @method ActionIndex
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return string
     * */
    public function ActionIndex(array $patch = null)
    {
        echo 'Класс юзера выводит имя юзера: ' . $patch[0] . $patch[1];
    }

    /**
     * @method ActionUsers
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return string
     * */
    public function ActionUsers(array $get = null)
    {
        echo 'users_dann';
    }

    /**
     * @method ActionUserst
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return text/html
     * */
    public function ActionUserst()
    {
        $data = [
            'data' => 'testing'
        ];
        return View::render($this->template, $data);
    }
}
