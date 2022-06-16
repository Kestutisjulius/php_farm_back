<?php
require __DIR__.'./db/JsonDb.php';
class App{

    

    public static function start(){
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($uri);
        array_shift($uri);
        self::route($uri);
    }

    
    
    private static function route(array $uri){

        $db = new JsonDb('farm');
        $method = $_SERVER['REQUEST_METHOD'];

        if ('GET' == $method && count($uri) == 1 && $uri[0] === ''){
            echo json_encode($db->showAll());
         }
    }
}