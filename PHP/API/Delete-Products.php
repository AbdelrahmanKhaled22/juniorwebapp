<?php
// Load the dependencies of this file
require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductData\Product;
//----------------------------------------//


// Parse the json from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Storing all the ids of the items that should be deleted
$ids = $data['ids'];

try {

    // Establishing a connection with the db
    $db = new Database();

    $pdo = $db->getConnection();


    // This static function takes the connection and ids as arguments and executes a delete statement
    Product::deleteByIds($pdo, $ids);


    echo json_encode(['status' => 'success']);
} catch (\PDOException $e) {
    echo $e->getMessage();
}
