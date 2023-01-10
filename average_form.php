<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';
require 'conf/config.php';

//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//recuper la lista di stati
$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME;

//Creazione della connessione
$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);


$stmt = $pdo->query('SELECT DISTINCT state FROM election_data');
$states = $stmt->fetchAll();

$sql = 'SELECT DISTINCT state_po FROM election_data';

$stmt = $pdo->query($sql);

$list = $stmt->fetchAll();


$flags = [];
foreach ($list as $row) {
    array_push($flags, strtolower($row['state_po']));
}

$data = [
    'states' => $states,
    'flags' => $flags,
];

echo $templates->render("average_form", $data);

