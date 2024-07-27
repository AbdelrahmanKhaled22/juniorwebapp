<?php

// Load the dependencies of this file
require __DIR__ . '/../vendor/autoload.php';

use ProductData\Database;
use ProductAPI\ProductAPI;
//----------------------------------------//

$db = new Database();

$api = new ProductAPI($db->getConnection());

$api->handleRequest();
