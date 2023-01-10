<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';

//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//recuper la lista di stati
$dsn = 'mysql:host=localhost;dbname=us_presidential_election';

$pdo = new PDO($dsn, 'root', '');

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

echo $templates->render("comparison_form", $data);

