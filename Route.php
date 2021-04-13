<?php
namespace Source;
 
final class Route
{
    private $_uri;
    private $_controller;
    private $_action;
    private $_name;
    private $_requirements;
    private $_items;
    private $_parameters;

    /**
     * __construct
     *
     * @param string $uri          uri
     * @param string $controller   controller
     * @param string $action       action
     * @param string $name         name (default:"")
     * @param string $requirements requirements(default:[])
     */
    public function __construct($uri, $controller, $action="route", $name="", $requirements = [])
    {
        $this->_uri = $uri;
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_name = $name;
        $this->_requirements = $requirements;
        $this->_initParameters();
    }

    /**
     * Function _isParameter
     *
     * @param string $item item
     *
     * @return bool true if an item is a well formed parameter
     */
    private function _isParameter($item)
    {
        return substr($item, 0, 1) == '{' && substr($item, -1, 1) == '}';
    }

    /**
     * Function _getParameterName
     *
     * @param string $item item
     *
     * @return string the parameter name
     */
    private function _getParameterName($item)
    {
        return substr($item, 1, strlen($item) -2);
    }

    /**
     * Procedure _initParameters
     * - explode items from uri
     * - check items
     * - set parameters to null
     *
     * @return void
     */
    private function _initParameters()
    {
        $this->_items = array();
        $this->_parameters = array();
        $items = explode('/', $this->_uri);
        foreach ($items as $item) {
            // check if item is not an empty string
            if (trim($item) != '') {
                // add the item in the items list
                array_push($this->_items, $item);
                // check if it's a paramater
                if ($this->_isParameter($item)) {
                    // store the parameter name as a key
                    $name = $this->_getParameterName($item);
                    $this->_parameters[$name] = null;
                }
            }
        }
    }

    /**
     * Function getParameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->_parameters;
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
     * Function getController
     *
     * @return string
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * Function getAction
     *
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * Function getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Function getRequirements
     *
     * @return array
     */
    public function getRequirements()
    {
        return $this->_requirements;
    }

    /**
     * Function match
     *
     * @param string $uri uri
     *
     * @return bool true is uri match route
     */
    public function match($uri)
    {
        // if there is no pamareter in this route
        if (!count($this->_parameters)) {
            // there is no parameter
            // match the whole uri route
            $match = $uri == $this->_uri;
        } else {
            $match = true;
            
            // match each item from uri and store parameters
            
            $uri_items = explode('/', $uri);
            if ($uri_items[0] == '') {
                array_shift($uri_items);
            }

            $count_items = count($this->_items);
            $count_uri_items = count($uri_items);
            $last_item = $this->_items[$count_items - 1];
            if ($this->_isParameter($last_item)) {

                // last item is a parameter : matching the n-1 first items
                // the end of route is ignored

                // check count uri items
                if ($count_uri_items >= $count_items) {
                    // pop the last parameter
                    array_pop($this->_items);
                    // check the n-1 first items
                    foreach ($this->_items as $index => $item) {
                        $uri_item = array_shift($uri_items);
                        $match = $this->matchUriItem($uri_item, $index);
                        if (!$match) {
                            break;
                        }
                    }
                    if ($match) {
                        // store the last parameter without matching
                        $name = $this->_getParameterName($last_item);
                        $value = implode('/', $uri_items);
                        $match = $this->storeParameter($name, $value);
                    }
                } else {
                    $match = false;
                }
            } else {
                if (count($uri_items) == count($this->_items)) {
                    foreach ($uri_items as $index => $uri_item) {
                        $item = $this->_items[$index];
                        // check if the uri item is a parameter value
                        $match = $this->matchUriItem($uri_item, $index);
                        if (!$match) {
                            break;
                        }
                    }
                } else {
                    $match = false;
                }
            }
        }

        return $match;
    }

    /**
     * Function matchUriItem
     *
     * @param string $uri_item item in uri at index
     * @param int    $index    index
     *
     * @return bool true if uri item at index match route
     */
    public function matchUriItem($uri_item, $index)
    {
        $match = true;
        // check if the uri item is a parameter value
        if ($this->_isParameter($this->_items[$index])) {
            // get parameter name
            $name = $this->_getParameterName($this->_items[$index]);
            $value = $uri_item;
            $match = $this->storeParameter($name, $value);
        } else {
            // check if uri item is matching route item
            if ($uri_item != $this->_items[$index]) {
                // uri item doesn't match route item
                $match = false;
            }
        }
        return $match;
    }

    /**
     * Function storeParameter
     *
     * @param string $name  parameter name
     * @param mixed  $value parameter value
     *
     * @return true if value match requirements
     */
    public function storeParameter($name, $value)
    {
        $match = true;
        // check if there are specific requirements for the parameter
        if (isset($this->_requirements[$name])) {
            // check the requirements
            if (!preg_match($this->_requirements[$name], $value)) {
                // doesn't match requirements
                $match = false;
            }
        }
        if ($match) {
            // store parameter value
            $this->_parameters[$name] = $value;
        }
        return $match;
    }

    /**
     * Procedure execute
     * call the controller
     *
     * @return void
     */
    public function execute()
    {
        $classname = "Source\\controllers\\" . $this->_controller;
        $controller = new $classname();

        call_user_func_array(array($controller, $this->_action), $this->_parameters);
    }
}