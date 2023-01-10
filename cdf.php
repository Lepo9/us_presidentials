<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';

//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//recuper la lista di tutti i candidati
$dsn = 'mysql:host=localhost;dbname=us_presidential_election';

$pdo = new PDO($dsn, 'root', '');

$stmt = $pdo->query('SELECT DISTINCT candidate FROM election_data');
$list = $stmt->fetchAll();

$candidates = [];

foreach ($list as $row) {
    $candidate = $row['candidate'];
    if ($candidate != 'OTHER' && $candidate != 'OTHERS' && $candidate != '')
        array_push($candidates, $candidate);
}
sort($candidates);

$data = [
    'candidates' => $candidates,
];

echo $templates->render("cdf", $data);

