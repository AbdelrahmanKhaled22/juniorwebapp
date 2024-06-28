<?php

namespace ProductData;

require_once __DIR__ . "/../Config/Config.php";
require_once __DIR__ . "/../Data/Database.php";
require_once __DIR__ . "/../Data/Product.php";
require_once __DIR__ . "/../Data/Book.php";
require_once __DIR__ . "/../Data/DVD.php";
require_once __DIR__ . "/../Data/Furniture.php";

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
