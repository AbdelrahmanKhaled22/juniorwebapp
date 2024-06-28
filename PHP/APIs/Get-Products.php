<?php

namespace ProductData;

require_once __DIR__ . "/../Data/Database.php";
require_once __DIR__ . "/../Data/Product.php";
require_once __DIR__ . "/../Data/Book.php";
require_once __DIR__ . "/../Data/DVD.php";
require_once __DIR__ . "/../Data/Furniture.php";


header('Access-Control-Allow-Origin: http://localhost:3000', "Content-type: application/json");


$db = new Database();

$pdo = $db->getConnection();



try {
    $data = Product::load($pdo);
    // Output as JSON
    echo json_encode($data);
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
