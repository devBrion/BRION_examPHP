<?php
namespace Source;

class View
{
    private static $template = null;
    private static $variables = [];

    public static function setTemplate($name)
    {
        self::$template = "view/" . $name . ".html.php";
    }

    public static function bindVariable($name, $value)
    {
        self::$variables[$name] = $value;
    }

    public static function display()
    {
        // boucle de création de variables
        foreach (self::$variables as $name => $value)
        {
            $$name = $value;
        }

        // Récupération de la racine de l'url
        $router = new Router();
        $path =  $router->getBasePath();
        
        require self::$template;
    }
}