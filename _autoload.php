<?php

// 定义工具类在服务器位置 常量
define('TOOLS_ROOT', __DIR__ . '/');

//文件 autoloadClass.php ,需要new的文件
class AutoloadClass{

    public function __construct()
    {
        // echo '你已经包含我了';
    }
}

// 第一种实现方法
//文件autoloadDemo.php文件
spl_autoload_register('myAutoLoad', true, true);
function myAutoLoad($className){
    $classFileName = TOOLS_ROOT."{$className}.php";
    include_once $classFileName;

}
$objDemo = new AutoloadClass();

// 匿名函数的实现方式
//spl_autoload_register(function ($className)
//{
//    $classFileName = TOOLS_ROOT."{$className}.php";
//    include_once $classFileName;
//}, true, true);
//$objDemo = new AutoloadClass();


/**
 * 格式化打印数据
 */
function dump() {

    $args = func_get_args();
    foreach ($args as $val) {
        echo '<pre style="color: red">';
        var_dump($val);
        echo '</pre>';
    }

}


/**
 * 格式化打印数据 下断点
 */
function dd() {

    $args = func_get_args();
    foreach ($args as $val) {
        echo '<pre style="color: red">';
        var_dump($val);
        echo '</pre>';
    }
    exit;

}


function t($name = ''){

    static $_modules = array();
    if (isset($_modules[$name]))
    {
        return $_modules[$name];
    }
    $model = TOOLS_ROOT . strtolower($name) . 'Tools.php';
    if (!(is_file($model)))
    {
        exit(' Model ' . $name . ' Not Found!');
    }
    require_once $model;
    $class_name = ucfirst($name).'Tools';
    $_modules[$name] = new $class_name();

    return $_modules[$name];

}