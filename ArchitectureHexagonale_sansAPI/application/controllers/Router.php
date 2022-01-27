<?php

class Router
{
    private $_controller;
    private $_presentation;

    public function routeReq()
    {

        $url = [];
        $controller = '';

        if (isset($_GET['url'])) {
            $url = explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
            switch ($url[0]) {
                case "carte":
                    $controller = 'CarteController';
                    break;
                case "commande":
                    $controller = 'CommandeController';
                    break;
                case "plan":
                    $controller = 'PlanController';
                    break;
                default:
                    $controller = 'PlatController';
            }

            $controllerFile = 'application/controllers/' . $controller . '.php';

            if (file_exists($controllerFile)) {
                require_once($controllerFile);
                $this->_controller = new $controller($url);
            } else {
                echo("Page not found");
            }
        } else {
            require_once('application/controllers/PlatController.php');
            $this->_controller = new PlatController($url);
        }
    }
}
