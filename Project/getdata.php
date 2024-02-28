<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'vendor/autoload.php'; 
use Exception;
use MongoDB\Client;
use MongoDB\Driver\ServerApi;

// Параметры подключения к MongoDB

if (isset($_REQUEST['source'])) {
    $uri = $_REQUEST['source'];
} 
else {
    $uri = 'mongodb://admin:36BbnDJNCcAJEWaoTlzmgRpzK@192.168.200.56:27017,192.168.200.57:27017,192.168.200.58:27017/?replicaSet=mongo_repl';
}

$client = new MongoDB\Client($uri);

// Выбор базы данных и коллекции


// Получение всех записей из коллекции movies
try{
    $start_time = microtime(true);
    $database = $client->selectDatabase('demo');    
    $collection = $database->movies;
    $cursor = $collection->find([]);

}
catch (Exception $e) {
    printf($e->getMessage());
}
$end_time = microtime(true);
$execution_time = ($end_time - $start_time);
echo $execution_time;

?>

<?php

// Create a new client and connect to the server

