<?php
//FRONT CONTROLLER

//1. Общие настройки
//Отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

//2. Подключение необходимых файлов
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Router.php');

//3. Установка соединения с БД

//4. Вызов роутора
$router = new Router();
$router->run();
