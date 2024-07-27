<?php

namespace ProductAPI;

// Load the dependencies of this file
require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductData\Book;
use ProductData\Furniture;
use ProductData\DVD;
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
        // Mapping of types to class names
        $classMap = [
            'Book' => 'ProductData\\Book',
            'Furniture' => 'ProductData\\Furniture',
            'DVD' => 'ProductData\\DVD'
        ];
        // Parse the incoming json
        $payload = json_decode(file_get_contents('php://input'), true);
        $type = $payload['type']; // Type from frontend payload
        // Ensure the type is valid and exists in the class map
        if (isset($classMap[$type])) {
            $className = $classMap[$type];

            // Extract constructor arguments from payload
            $constructorArgs = [
                'sku' => $payload['sku'],
                'name' => $payload['name'],
                'price' => $payload['price'],
            ];

            // Add attributes based on type dynamically
            $typeAttributes = [
                'Book' => ['author', 'weight'],
                'Furniture' => ['material', 'dimensions'],
                'DVD' => ['size'],
            ];

            // Add type-specific attributes to constructor arguments
            foreach ($typeAttributes[$type] as $attribute) {
                if (isset($payload[$attribute])) {
                    $constructorArgs[$attribute] = $payload[$attribute];
                }
            }

            // Print out the final constructor arguments to debug
            error_log(print_r($constructorArgs, true));

            // Using Reflection to dynamically create an instance
            try {
                $reflectionClass = new \ReflectionClass($className);
                // Passing in constructorArgs is the same as passing in named parameters for any of our classes dynamically
                $productInstance = $reflectionClass->newInstanceArgs($constructorArgs);

                // Call the save method on the dynamically created instance
                $productInstance->save($this->db);

                // Output success or handle further logic
                echo json_encode(['message' => 'Product saved successfully']);
            } catch (\ReflectionException $e) {
                echo json_encode(['error' => 'Error creating product instance: ' . $e->getMessage()]);
            } catch (\PDOException $e) {
                echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
            }
        } else {
            // Handle invalid type error
            echo json_encode(['error' => 'Invalid product type']);
        }
    }

    private function handleDelete()
    {
        // Parse the json from the POST request
        $data = json_decode(file_get_contents('php://input'), true);

        // Storing all the ids of the items that should be deleted
        $ids = $data['ids'];
        try {

            // Establishing a connection with the db



            // This static function takes the connection and ids as arguments and executes a delete statement
            ProductModel::deleteByIds($this->db, $ids);


            echo json_encode(['status' => 'success']);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function sendResponse($statusCode, $data)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
