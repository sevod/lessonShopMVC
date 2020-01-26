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
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                echo '<br>' . $uriPattern;
                echo '<br>' . $path;
                echo '<br>' . $uri;
                echo '<br>' . $internalRoute;
                echo '<br>';

                //определяем какой контроллер и action обрабатывает запрос
                $segment = explode('/', $internalRoute);
                $controllerName = array_shift($segment).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segment));

                echo '<br>controller name: ' . $controllerName;
                echo '<br> action name: ' . $actionName;

                $parameters = $segment;
                echo '<pre>';
                print_r($parameters);

                //Подключаем файл класса-контроллера
                $controllerFile = ROOT . '/controllers/'.$controllerName.'.php';
                //echo $controllerFile;
                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }

                //Создать объект, вызвать метод (т.е. action)
                //echo $controllerName;
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName($parameters);
                if ($result != null){
                    break;
                }
            }
        }
    }
}