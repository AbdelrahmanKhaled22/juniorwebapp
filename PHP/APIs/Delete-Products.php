<?php

require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductData\Product;


// Get the data from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$ids = $data['ids'];

try {

    $db = new Database();

    $pdo = $db->getConnection();

    Product::deleteByIds($pdo, $ids);


    echo json_encode(['status' => 'success']);
} catch (\PDOException $e) {
    echo $e->getMessage();
}
