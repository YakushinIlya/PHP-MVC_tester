<?php
/**
 * Class Router
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace app\system;

class Router
{
    /**
     * @var request array Запрос из адресной строки
     * @var patch   array Пользовательские параметры из адресной строки
     * @var rout    array Настройки шаблонов запросов
     * */
    public $request = [];
    public $patch   = [];
    public $rout    = [];

    /**
     * construct Router
     *
     * @param string Полный запрос из адресной строки кроме домена
     *
     * Получаем запрос.
     * Если запрос не пустой и нет ответа в виде массива от метода getConfigRout
     * то делим запрос на элементы массива по слешу / и заносим результат в свойство $request.
     *
     * Если метод getConfigRout дал ответ в виде массива то присваиваем свойству $request
     * три элемента массива: controller, action, patch.
     *
     * Иначе если метод getConfigRout не дал ответа в виде массива и/или запрос пустой.
     * то присваиваем свойству $request значения по умолчанию: controller, action.
     * */
    public function __construct(string $request = null)
    {
        $request = trim($request, '/');
        if (!empty($request) && !is_array($this->getConfigRout($request))) {
            $this->request = explode('/', $request);
        } elseif (is_array($this->getConfigRout($request))) {
            $this->request = [
                $this->getConfigRout($request)['controller'],
                $this->getConfigRout($request)['action'],
                $this->getConfigRout($request)['patch']
            ];
        } else {
            $this->request = [
                CTRL,
                ACTN
            ];
        }
    }

    /**
     * @method run
     *
     * Берем данные из свойства $request, делаем первую букву заглавйной
     * и формируем пути до контроллера и экшена.
     *
     * Если существует class контроллера и метод экшена в этом классе
     * то создаем объект класса и обращаемся к методу.
     *
     * Иначе обращаемся к методу error.
     *
     * @return Возвращает ассоциативный массив данных
     * */
    public function run()
    {
        $ctrl = 'App\Controller\Controller' . ucfirst($this->request[0]);
        $actn = 'Action' . ucfirst($this->request[1]);

        if (class_exists($ctrl)) {
            if (method_exists($ctrl, $actn)) {
                $controller = new $ctrl();
                $controller->$actn($this->request[2]);
            } else {
                $this->error(404);
            }
        } else {
            $this->error(404);
        }
    }

    /**
     * @method getConfigRout
     *
     * Получаем запрос, делим его на элементы массива.
     *
     * Проверяем наличие шаблона запроса в файле resource/rout.php
     * Если есть полное совпадение то возвращаем массив настроек.
     *
     * Если шаблон по запросу не найден и запрос не пустой
     * то первое значение запроса возвращаем как controller
     * второе значение запроса возвращаем как action
     * остальные значения запроса возвращаем как массив patch.
     *
     * Если нет совпадения запроса в шаблонах запросов
     * и запрос пустой, то возвращаем false.
     *
     * @param  string Полный запрос из адресной строки кроме домена
     * @return array Возвращает ассоциативный массив либо false
     * */
    public function getConfigRout(string $request = null)
    {
        $req  = [];
        $ctrl = '';
        if (!empty($request)) {
            $req = explode('/', $request);
        }
        $this->rout = require 'resource/rout.php';
        if (is_array($this->rout) && array_key_exists($request, $this->rout)) {
            return $this->rout[$request];
        } elseif (!empty($req)) {
            for ($i=1; count($req)>$i; $i++) {
                $patch[] = $req[$i];
            }
            $this->patch = $patch;
            $rout = $this->rout[$req[0]];
            return [
                'controller' => $rout['controller'],
                'action'     => $rout['action'],
                'patch'      => $this->patch
            ];
        } else {
            return false;
        }
    }

    /**
     * @method error
     *
     * @param  string Номер ошибки
     * @return string Останавливаем работу приложения и выводим номер ошибки
     * */
    public function error(string $number = null)
    {
        exit('Номер ошибки: ' . $number);
    }
}
