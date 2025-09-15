<?php

class ApiConfig{

    public function methodHandler($method) 
    { 
       header('Content-Type: application/json');

       if ($_SERVER['REQUEST_METHOD'] != $method) {
            $result = [
                'status' => false,
                'message' => 'Method Not Allowed',
            ];
        
            echo json_encode($result, JSON_PRETTY_PRINT);

            die();
        }

    }

}