<?php
/**
 * Class Controller
 *
 * @package mvcproject
 * @version 1.0
 * @author Илья Якушин <yakushinilya74@gmail.com>
 * @copyright 2019
 * */

namespace App\system;

use App\system\View;

abstract class Controller
{
    /**
     * @var string Название HTML шаблона по умолчанию (resource/Wiew/template/mytemplate.php)
     * */
    public $template = 'mytemplate';

    /**
     * @var object class View
     * */
    public $view;
    
    public function __construct()
    {
        $this->view = new View();
    }
}
