<?php
/**
 * Class HTTP
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\system;

class HTTP
{
    /**
     * @method redirect
     *
     * Производит редирект на полученный URL
     * */
    public static function redirect(string $url = null, int $port = 302)
    {
        header('Location: ' . $url, true, $port);
    }

    /**
     * @method sessionStart
     *
     * Создает два массива сессий из полученных данных
     * */
    public static function sessionStart(array $user = null, array $dann = null)
    {
        if (is_array($user)) {
            $_SESSION['userAuth'] = $user;
        }

        if (is_array($dann)) {
            $_SESSION['userDann'] = $dann;
        }
    }

    /**
     * @method sessionOut
     *
     * Удаляет сессию с полученным названием
     * */
    public static function sessionOut(string $session = null)
    {
        unset($_SESSION[$session]);
    }

    /**
     * @method cookieStart
     *
     * Создает COOKIE из полученных данных и шифрует их. Время жизни COOKIE
     * устанавливается в файле app/system/config.php
     * */
    public static function cookieStart(array $user = null, array $dann = null, int $time = 0)
    {
        if (is_array($user)) {
            $userAuth = null;
            foreach ($user as $val) {
                $userAuth .= $val.'|';
            }
            setcookie('userAuth', base64_encode(trim($userAuth, '|')), time() + $time);
        }

        if (is_array($dann)) {
            $userDann = null;
            foreach ($dann as $val) {
                $userDann .= $val.'|';
            }
            setcookie('userDann', base64_encode(trim($userDann, '|')), time() + $time);
        }
    }

    /**
     * @method cookieOut
     *
     * Удаляет COOKIE с полученным названием
     * */
    public static function cookieOut(string $cookies = null, int $time = 0)
    {
        setcookie($cookies, '', time() - $time);
    }
}
