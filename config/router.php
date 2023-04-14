<?php


$request_uri = $_SERVER['REQUEST_URI'];

if ($request_uri == "/A-Kawan-Idrees-Mawlood3/dashboard") {
    require 'views/pages/dashboard.php';
  } elseif ($request_uri == '/A-Kawan-Idrees-Mawlood3/account') {
    require 'views/pages/account.php';
  }
  elseif ($request_uri == '/A-Kawan-Idrees-Mawlood3/') {
    require 'login.php';
  }
   else {
    http_response_code(404);
    echo "404 Not Found";
  } 