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

$apiVersion = new ServerApi(ServerApi::V1);
$database = 'demo';
$client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);


try {
// Конфигурация запроса
// Подключение к MongoDB по URI строке
$client = new MongoDB\Client($uri);

// Выполнение команды в MongoDB
$database = $client->selectDatabase('admin');
$command = new MongoDB\Driver\Command(['ismaster' => 1]);

// Выполнение команды и получение результата
$result = $client->getManager()->executeCommand('admin', $command);

// Получение значения primary из результата
$primary = '';

foreach ($result as $document) {
    $primary = $document->primary;
    break; // Прерываем цикл после первого документа
}

// Вывод результата
echo "Master: $primary";
}
    catch (Exception $e) {
    printf($e->getMessage());
}

/*
// Начало отсчета времени


// Подключение к MongoDB с аутентификацией
try {
    $mongoClient = new MongoDB\Client($server);
    
    $mongoDatabase = $mongoClient->$database;
    
    // Успешное подключение
  
    
    
} catch (Exception $e) {
    echo 'Ошибка подключения к MongoDB: ' . $e->getMessage();
}*/

?>

<?php

// Create a new client and connect to the server

