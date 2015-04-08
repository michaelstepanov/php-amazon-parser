<?php

use vendor\core\App;

require_once(dirname(__FILE__).'/config.php');

$query = null;

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query'];

    try {
        // gets first products' Title, Price, Image URL and Description
        $firstProduct = App::getFirstProduct($query);
    } catch (Exception $e) {
        die('Error: '.$e->getMessage());
    }
}

// view file
require_once(dirname(__FILE__).'/views/index.php');