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
use App\Model\User;
use App\system\HTTP;
use App\Model\Nav;

class ControllerUser extends Controller
{
    /**
     * @var string Название HTML шаблона (resource/Wiew/template)
     * */
    public $template = 'mytemplate';

    /**
     * @method ActionAuth
     *
     * Метод авторизации пользователей, выводит страницу с формой авторизации.
     *
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return text/html
     * */
    public function ActionAuth()
    {
        $data = [
            'title' => 'Авторизация',
            'alert' => '',
            'navigation' => Nav::top_menu(),
            'navauth' => Nav::auth_menu(),
        ];
        if (isset($_POST['passwords'])) {
            $data['alert'] = User::auth($_POST['emails'], $_POST['passwords']);
        }
        
        return View::render($this->template, $data, ['content' => 'user/auth']);
    }

    /**
     * @method ActionReg
     *
     * Метод регистрации пользователей, выводит страницу с формой регистрации.
     *
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return text/html
     * */
    public function ActionReg()
    {
        $data = [
            'title' => 'Регистрация',
            'alert' => '',
            'navigation' => Nav::top_menu(),
            'navauth' => Nav::auth_menu(),
        ];
        if (isset($_POST['passwords'])) {
            $data['alert'] = User::reg($_POST['names'], $_POST['emails'], $_POST['passwords']);
        }
        
        return View::render($this->template, $data, ['content' => 'user/reg']);
    }

    /**
     * @method ActionOut
     *
     * Метод регистрации пользователей, выводит страницу с формой регистрации.
     *
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return text/html
     * */
    public function ActionOut()
    {
        HTTP::cookieOut('userAuth');
        HTTP::cookieOut('userDann');
        HTTP::redirect('/');
    }
}
