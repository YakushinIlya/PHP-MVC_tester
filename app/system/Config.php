<?php
/**
 * Configuration file
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

//session_start();

/**
 * Constants
 *
 * @var CTRL string Контроллер по умолчанию
 * @var ACTN string Экшен по умолчанию
 *
 * @var TIME_COOK integer Время жизни cookies в секундах
 * */
define("CTRL", "Home");
define("ACTN", "Index");

define("TIME_COOK", 604800);

/**
 * Constants
 *
 * @var $DB_TYPE string тип СУБД
 * @var $DB_CHAR string кодировка соединения с БД
 * @var $DB_HOST string сервер БД
 * @var $DB_NAME string имя БД
 * @var $DB_USER string имя пользователя БД
 * @var $DB_PASS string пароль пользователя БД
 * */
define("DB_type", "mysql");
define("DB_char", "utf8");
define("DB_host", "localhost");
define("DB_name", "tester");
define("DB_user", "root");
define("DB_pass", "12345");
