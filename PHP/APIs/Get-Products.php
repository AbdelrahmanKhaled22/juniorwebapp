<?php
// Load the dependencies of this file
require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductData\Product;
//----------------------------------------//

// Establish the connection
$db = new Database();

$pdo = $db->getConnection();



try {
    // Static function fetches all of the products from the db
    $data = Product::load($pdo);
    // Output as JSON
    echo json_encode($data);
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
