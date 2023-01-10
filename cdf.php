<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';
require 'conf/config.php';


//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//recuper la lista di tutti i candidati
$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME;

//Creazione della connessione
$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

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

