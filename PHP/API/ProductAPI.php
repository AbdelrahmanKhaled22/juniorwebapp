<?php

namespace ProductAPI;

// Load the dependencies of this file
require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductData\Product as ProductModel;
//----------------------------------------//

class ProductAPI
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                return $this->handleGet();
            case 'POST':
                return $this->handlePost();
            case 'DELETE':
                return $this->handleDelete();
            default:
                return $this->sendResponse(405, 'Method Not Allowed');
        }
    }

    private function handleGet()
    {
        $data = ProductModel::load($this->db);
        echo json_encode($data);
    }

    private function handlePost()
    {
    }

    private function handleDelete()
    {
    }

    private function sendResponse($statusCode, $data)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
