<?php
/**
 * Class DB
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\system;

use \PDO;
use \PDOException;
use App\system\traits\DataBase;

class DB
{
    use DataBase;

    /**
     * construct DB
     *
     * Подключаемся к БД.
     * В случае неудачного подключения выводим исключение с ошибкой.
     * */
    private function __construct()
    {
        try {
            $this->db = new PDO(
                self::$DB_TYPE . ':host=' . self::$DB_HOST . ';dbname=' .
                self::$DB_NAME,
                self::$DB_USER,
                self::$DB_PASS,
                [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
            );
        } catch (PDOException $e) {
            exit("Не удалось подключиться к БД: " . $e->getMessage());
        }
    }

    /**
     * @method queryAssoc
     *
     * @param string SQL запрос
     * @return array Возвращает ассоциативный массив данных
     * */
    public function queryAssoc(string $sql = null)
    {
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @method queryObj
     *
     * @param string SQL запрос
     * @return object Возвращает объект данных
     * */
    public function queryObj(string $sql = null)
    {
        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * destruct DB
     *
     * */
    final public function __destruct()
    {
        self::$ins = null;
    }
}
