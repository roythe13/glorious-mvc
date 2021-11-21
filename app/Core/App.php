<?php

namespace App\Core;

class App
{

    private $path = "App\Controller\\";
    private $controller = "Home";
    private $method = "index";
    private $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if ($url) {
            if (file_exists(__DIR__ . "/../Controller/" . $url[0] . ".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        $controllerPath = $this->path . $this->controller;
        $this->controller = new $controllerPath;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl(): ?array
    {
        if (isset($_SERVER["PATH_INFO"])) {
            $url = trim($_SERVER["PATH_INFO"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }

        return null;
    }
}
