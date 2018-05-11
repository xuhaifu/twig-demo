<?php
/**
 * Created by index.php
 * Author: XHF
 * Date: 2018/5/11
 * Time: 16:59
 */

define('APP_PATH',dirname(__FILE__));

require "libraries/Twig.php";
require "config/twig.php";



class twig_demo
{
    public function __construct(array $config)
    {
        $this->twig = new Twig($config);
    }

    public function index()
    {
        $data = [
            'name' => 'Bobby'
        ];
        $this->twig->assign('name',$data);
        $this->twig->render('index');
    }

}

$twig_demo = new twig_demo($config);

$twig_demo->index();



