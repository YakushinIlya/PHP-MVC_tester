<?php
/**
 * Class Nav
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\Model;

use App\system\DB;
use App\system\View;

class Nav
{
    /**
     * @method top_menu
     *
     * @return Возвращает список основного меню из БД в тегах <li></li>
     * */
    public static function top_menu()
    {
        $db = DB::getIns();
        $res = $db->queryAssoc("select * from navigation_top where loc='left'");

        for ($i=0; count($res)>$i; $i++) {
                $element .= View::patch('nav_top', [
                    'url'   => $res[$i]['url'],
                    'class' => $res[$i]['class'],
                    'head'  => $res[$i]['head'],
                ]);
        }
        return $element;
    }

    /**
     * @method auth_menu
     *
     * @return Возвращает правую часть меню из БД в тегах <li></li>
     * Вход с регистрацией если не авторизован, если же авторизован
     * то ссылку в профиль и выход
     * */
    public static function auth_menu()
    {
        $auth = function () {
            if (empty($_COOKIE['userAuth'])) {
                return 0;
            } else {
                return 1;
            }
        };
        $db = DB::getIns();
        $res = $db->queryAssoc("select * from navigation_top where loc='right' && auth='{$auth()}'");

        for ($i=0; count($res)>$i; $i++) {
                $element .= View::patch('nav_auth', [
                    'auth'  => $res[$i]['auth'],
                    'url'   => $res[$i]['url'],
                    'class' => $res[$i]['class'],
                    'head'  => $res[$i]['head'],
                ]);
        }

        return $element;
    }
}
