<?php
/**
 * Class View
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\system;

class View
{
    /**
     * @method render
     *
     * Если параметр $dann является массивом то перебираем его элементы
     * и каждый элемент подставляем в адрес который передаем методу getContents
     * ответ метода getContents присваиваем обратно в массив $dann
     * затем объединяем массивы $contents и $dann.
     *
     * Если параметр $contents не является пустым
     * то обращаем все его элементы в переменные
     * затем стыкуем файл шаблона с названием из параметра $template
     * который принимает все вышеописанные параметры в виде переменных.
     *
     * @param  string $template, array $contents, array $dann
     * @return Возвращает ассоциативный массив данных
     * */
    public static function render(string $template, array $contents = null, array $dann = null)
    {
        if (is_array(($dann))) {
            foreach ($dann as $key => $val) {
                $dann[$key] = self::getContents("resource/View/patch/{$val}.php");
            }
            $contents = array_merge($contents, $dann);
        }
        if (!empty($contents)) {
            extract($contents);
        }
        require "resource/View/template/{$template}.php";
    }

    /**
     * @method patch
     *
     * @param  string $patch, array $dann
     * @return text/html
     * */
    public static function patch(string $patch = null, array $dann = [])
    {
        $res = self::getContents("resource/View/patch/{$patch}.php", $dann);
        return $res;
    }
    
    /**
     * @method getContents
     *
     * Производим POST запрос средством CURL с данными из параметра $dann
     * в файл находящийся по адресу из параметра $url
     * возвращаем ответ файла.
     *
     * @param  string $url, array $dann
     * @return Возвращает text/html
     * */
    public static function getContents(string $url_patch, array $dann = [])
    {
        ob_start();
        extract($dann);
        require $url_patch;
        $content = ob_get_contents();
        $contrnt = ob_get_clean();

        return $content;
    }
}
