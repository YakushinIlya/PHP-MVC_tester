<?php
/**
 * Class ControllerHome
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\Controller;

use App\system\Controller;
use App\system\View;
use App\system\DB;
use App\Model\Nav;

class ControllerHome extends Controller
{
    /**
     * @var string Название HTML шаблона (resource/Wiew/template)
     * */
    public $template = 'mytemplate';

    /**
     * @var array Передаваемые в шаблон данные
     * */
    public $data = [];

    /**
     * @method ActionIndex
     *
     * @return text/html
     * */
    public function ActionIndex()
    {
        $data = [
            'title' => 'Заголовок на главной',
            'navigation' => Nav::top_menu(),
            'navauth' => Nav::auth_menu(),
            'content' => '<h1>'.base64_decode($_COOKIE['userDann']).'</h1>'
            ];
        return View::render($this->template, $data);
    }

    /**
     * @method ActionIndex
     *
     * @return text/html
     * */
    public function ActionCompany()
    {
        $data = [
            'title' => 'О компании',
            'navigation' => Nav::top_menu(),
            ];
        return View::render($this->template, $data);
    }

    /**
     * @method ActionUserst
     *
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return text/html
     * */
    public function ActionUsers(array $get = null)
    {
        $db = DB::getIns();
        $res = $db->queryAssoc('select * from users');
        $data = [
            'title' => $res[0]['email']
            ];

        return View::render($this->template, $data);
    }

    /**
     * @method ActionUserst
     *
     * @param array Параметры передаваемые в адресной строке после основного адреса (user/{param})
     * @return text/html
     * */
    public function ActionUserst(array $get = null)
    {
        $data = [
            'data' => 'testing'
        ];
        return View::render($this->template, $data);
    }
}
