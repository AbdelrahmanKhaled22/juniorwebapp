<?php

require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductData\Product;


$db = new Database();

$pdo = $db->getConnection();



try {
    $data = Product::load($pdo);
    // Output as JSON
    echo json_encode($data);
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
