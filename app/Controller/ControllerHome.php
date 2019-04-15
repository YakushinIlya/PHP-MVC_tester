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
        echo 'index';
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
            'data' => $res[0]['email']
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
