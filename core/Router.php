<?php

namespace app\core;


class Router
{

    protected array $routes = [];
    public Request $request;
    public Response $response;


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $CallBack)
    {
        $this->routes['get'][$path] = $CallBack;
    }

    public function post($path, $CallBack)
    {
        $this->routes['post'][$path] = $CallBack;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callBack = $this->routes[$method][$path] ?? false;

        if ($callBack === false) {
            $this->response->setStatusCode(404);
            //return $this->renderContent("Not Found");
            return $this->renderView('_404');
        }

        if (is_string($callBack)) {
            return $this->renderView($callBack);
        }

        if (is_array($callBack)) {
            Application::$app->controller = new $callBack[0];
            $callBack[0] = Application::$app->controller;
        }

        return call_user_func($callBack, $this->request,$this->response);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
