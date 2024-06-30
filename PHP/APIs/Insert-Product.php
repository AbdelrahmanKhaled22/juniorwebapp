<?php

// Load the dependencies of this file

require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductData\Book;
use ProductData\Furniture;
use ProductData\DVD;
//----------------------------------------//


// Mapping of types to class names
$classMap = [
    'Book' => 'ProductData\\Book',
    'Furniture' => 'ProductData\\Furniture',
    'DVD' => 'ProductData\\DVD'
];

// Parse the incoming json
$payload = json_decode(file_get_contents('php://input'), true);

// A debugging statement
error_log("Received payload: " . print_r($payload, true));


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


        // Establish the connection
        $db = new Database();
        $pdo = $db->getConnection();

        // Call the save method on the dynamically created instance
        $productInstance->save($pdo);

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
