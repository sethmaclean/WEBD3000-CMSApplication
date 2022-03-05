<?php
    ob_start(); // output buffering turned on
    
    // Assign file paths to PHP constants
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . '/public');
    define("SHARED_PATH", PRIVATE_PATH . '/shared');

    // Assign the root URL to a PHP constant
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    // require_once,  because we do not want to define a function more than once.
    require_once('functions.php');
    require_once('database.php');
    require_once('query_functions.php');

    $db = db_connect();
    $errors = [];

?>