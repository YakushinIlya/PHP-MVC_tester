<?php
/**
 * Class User
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\Model;

use App\system\Mess;
use App\system\View;
use App\system\DB;
use App\system\HTTP;
use Exception;

class User
{
    /**
     * @var string Сообщения об ошибки валидации
     * */
    public static $mess = '';

    /**
     * @var boolean TRUE or FALSE
     * */
    public static $result = true;

    /**
     * @method reg
     *
     * @param string $name, string $email, string $pass - данные для регистрации
     * @return Создает куки и перенаправляет на главную при успешной регистрации,
     * при не успешной регистрации или валидации - выдает ошибку.
     * */
    public static function reg(string $name = null, string $email = null, string $pass = null)
    {
        if (!is_string($name) || !preg_match('/[А-Яа-я]/', $name)) {
            self::$mess .= Mess::rend('alert.user.name');
            self::$result = false;
        }
        if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$mess .= Mess::rend('alert.user.email');
            self::$result = false;
        }
        if (!is_string($pass) || !preg_match('/[A-Za-z0-9]/', $pass)) {
            self::$mess .= Mess::rend('alert.user.pass');
            self::$result = false;
        }

        if (self::$result==false) {
            $mess = self::$mess;
            $type = 'warning';
        } else {
            $pass = md5($pass);
            $db = DB::getIns();
            try {
                if (!$db->query("insert into users 
                (names, password, email) values 
                ('{$name}', '{$pass}', '{$email}')")) {
                    throw new Exception('alert.danger.reg');
                }
                HTTP::cookieStart([$email, md5($pass)], [$name, $email], TIME_COOK);
                HTTP::redirect('/', 301);
            } catch (Exception $e) {
                $mess = Mess::rend($e->getMessage());
                $type = 'danger';
            }
        }
                
        $result = View::patch('alert', ['message' => $mess, 'type' => $type]);
        self::$mess = null;
        self::$result = null;
        return $result;
    }

    /**
     * @method auth
     *
     * @param string $email, string $pass - данные для авторизации
     * @return Создает куки и перенаправляет на главную при успешной авторизации,
     * при не успешной авторизации выдает ошибку.
     * */
    public static function auth(string $email = null, string $pass = null)
    {
        if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$mess .= Mess::rend('alert.user.email');
            self::$result = false;
        }
        if (!is_string($pass) || !preg_match('/[A-Za-z0-9]/', $pass)) {
            self::$mess .= Mess::rend('alert.user.pass');
            self::$result = false;
        }

        if (self::$result==false) {
            $mess = self::$mess;
            $type = 'warning';
        } else {
            $pass = md5($pass);
            $db = DB::getIns();
            try {
                if (!$res = $db->queryAssoc("select names, email, password
                            	from users
                            	where email='{$email}' && password='{$pass}' 
                            	limit 1")) {
                    throw new Exception('alert.danger.auth');
                }
                    HTTP::cookieStart(
                        [$res[0]['email'], $res[0]['password']],
                        [$res[0]['names'], $res[0]['email']],
                        TIME_COOK
                    );
                    HTTP::redirect('/', 301);
            } catch (Exception $e) {
                $mess = Mess::rend($e->getMessage());
                $type = 'danger';
            }
        }
        
        $result = View::patch('alert', ['message' => $mess, 'type' => $type]);
        return $result;
    }
}
