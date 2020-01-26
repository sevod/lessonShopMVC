<?php


class Router
{
    private $routes;

    public function  __construct()
    {
            $routesPath = ROOT.'/config/routes.php';
            $this->routes = include($routesPath);
    }

    /**
     * returns request string URI
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        //Получить строку запроса
        $uri = $this->getURI();

        //Проверить наличие такого запроса в routers.php
        foreach ($this->routes as $uriPattern => $path){
            //echo "<br> $uriPattern   $path";
            if (preg_match("~$uriPattern~", $uri)){
                //определяем какой контроллер и action обрабатывает запрос
                $segment = explode('/', $path);
                $controllerName = array_shift($segment).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segment));

                //Подключаем файл класса-контроллера
                $controllerFile = ROOT . '/controllers/'.$controllerName.'.php';
                //echo $controllerFile;
                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }

                //Создать объект, вызвать метод (т.е. action)
                //echo $controllerName;
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null){
                    break;
                }
            }
        }
    }
}