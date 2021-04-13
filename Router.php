<?php
namespace Source;
 
final class Router
{
    private $_basePath;
    private $_uri;
    private $_routes;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->_routes = array();
        $this->_initBasePath();
        $this->_initUri();
    }

    /**
     * Procedure _initBasePath
     * initialize script base path
     *
     * @return void
     */
    private function _initBasePath()
    {
        $this->_basePath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1));
    }

    /**
     * Function getBasePath
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->_basePath;
    }


    /**
     * Function _initUri
     *
     * @return void
     */
    private function _initUri()
    {
        $uri = substr($_SERVER['REQUEST_URI'], strlen($this->_basePath.'/'));
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        $this->_uri = '/' . trim($uri, '/');
    }

    /**
     * Function getUri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * Procedure _initParameters
     *
     * @return void
     */
    private function _initParameters()
    {
        $this->parameters = array();
        $uri_array = explode('/', $this->_uri);
        foreach ($uri_array as $parameter) {
            if (trim($parameter) != '') {
                array_push($this->parameters, $parameter);
            }
        }
    }

    /**
     * Function getRoutes
     *
     * @return array Route Collection
     */
    public function getRoutes()
    {
        return $this->_routes;
    }

    /**
     * Procedure addRoute
     * 
     * @param object $route instanceof Route
     *
     * @return void
     */
    public function addRoute($route)
    {
        array_push($this->_routes, $route);
    }

    /**
     * Function findRoute
     *
     * @return object instanceof Route
     */
    public function findRoute()
    {
        $route = array_shift($this->_routes);
        while ($route != null && !$route->match($this->_uri)) {
            $route = array_shift($this->_routes);
        }
        return $route;
    }
}
?>