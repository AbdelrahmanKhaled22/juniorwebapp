<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one you want to allow
    $allowedOrigins = array('http://localhost:3000', 'http://juniordevtest-abdelrahman-khaled.000webhostapp.com');
    if (in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
        header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
    }
}

// Handle OPTIONS method (preflight request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Tell the client which methods are allowed
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    // Allow specific headers
    header("Access-Control-Allow-Headers: Content-Type");
    // Return response code 200 OK
    http_response_code(200);
    exit();
}
