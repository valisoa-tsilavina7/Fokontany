<?php
namespace Routes;

use Routes\Route;

class Router
{

    private array $routes;
    private string $url;
    public function __construct(string $url)
    {
        $this->url=trim($url,'/');
    }



    public function get(string $path,string $action)
    {
        $this->routes['GET'][]=new Route($path,$action);
    }

    public function post(string $path,string $action)
    {
        $this->routes['POST'][]=new Route($path,$action);
    }

    public function run()
    {
        // var_dump($this->routes[$_SERVER['REQUEST_METHOD']]);
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if($route->matches($this->url))
            {
                return $route->execute();
            }
        }

        return header('HTTP/1.0 404 not found ');
    }
    
}