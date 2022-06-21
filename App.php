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

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        if ('GET' == $method && count($uri) == 1 && $uri[0] === 'animals'){
            echo json_encode($db->showAll());
         }else
        if ('POST' == $method && count($uri) == 1 && $uri[0] === 'animals'){
            $rawData = file_get_contents("php://input");
            $data = json_decode($rawData, 1);
            $db->create($data);
            $message = ['msg' => 'OK, donkey'];
        $message = json_encode($message);
        print_r($message);
         }else
        if ($method == 'DELETE' && count($uri) == 2 && $uri[0] == 'animals') {
            $db->delete($uri[1]);
            $message = ['msg' => 'OK, donkey, deleted'];
            print_r($message);
        }else
        if ($method == 'PUT' && count($uri) == 2 && $uri[0] == 'animals') {
            $rawData = file_get_contents("php://input");

            $data = json_decode($rawData, 1);
            $db->update($uri[1], $data);
            $message = ['msg' => 'OK, donkey, edited'];
            print_r($message);
        }else{
            echo 'donkey, 404!';
        }

    }
}