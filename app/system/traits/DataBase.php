<?php
/**
 * Trait DataBase
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\system\traits;

trait DataBase
{
    /**
     * @var $ins null
     * @var $db  null
     * */
    private static $ins     = null;
    private $db             = null;

    /**
     * Приватные статические свойства принимающие данные констант
     * из App\system\config.php
     *
     * @var $DB_TYPE string тип СУБД
     * @var $DB_CHAR string кодировка соединения с БД
     * @var $DB_HOST string сервер БД
     * @var $DB_NAME string имя БД
     * @var $DB_USER string имя пользователя БД
     * @var $DB_PASS string пароль пользователя БД
     * */
    private static $DB_TYPE = DB_type;
    private static $DB_CHAR = DB_char;
    private static $DB_HOST = DB_host;
    private static $DB_NAME = DB_name;
    private static $DB_USER = DB_user;
    private static $DB_PASS = DB_pass;

    /**
     * clone DB
     *
     * Запрет клонирования объекта DB
     * */
    private function __clone()
    {
    }

    /**
     * clone DB
     *
     * Запрет повторного соединения вне класса DB
     * */
    private function __wakeup()
    {
    }

    /**
     * method getIns
     *
     * Проверяет наличие объекта DB в свойстве $ins
     * если объект отсутствует то объект будет присвоен свойству
     * */
    public static function getIns()
    {
        if (self::$ins instanceof self) {
            return self::$ins;
        }
        return self::$ins = new self;
    }
}
