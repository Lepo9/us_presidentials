<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';

//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//Qui ci sarebbe la parte di elaborazione sul modello,
//la M di MVC
//In questo esempio viene creato un vetto

$state = $_GET['state'];

$dsn = 'mysql:host=localhost;dbname=us_presidential_election';

//Creazione della connessione
$pdo = new PDO($dsn, 'root', '');

$stmt = $pdo->query('SELECT DISTINCT year FROM election_data');
$list = $stmt->fetchAll();
$years = []; //ci sono tutti gli anni
foreach ($list as $anno) {
    array_push($years, $anno['year']);
}

$stmt = $pdo->query('SELECT DISTINCT party_simplified FROM election_data');
$list = $stmt->fetchAll();
$parties = []; //ci sono tutti i partiti
foreach ($list as $partito) {
    array_push($parties, $partito['party_simplified']);
}

//creazione dell'array principale
$datas = [];
foreach ($years as $anno) {
    $datas[$anno] = [];
    foreach ($parties as $partito) {
        $datas[$anno][$partito] = 0;
    }
}

$sql = 'SELECT year, party_simplified, candidatevotes FROM election_data WHERE state = :state';
$stmt = $pdo->prepare($sql);

$stmt->execute(['state' => $state]);
$list = $stmt->fetchAll();
//var_dump($list);
foreach ($list as $row) {
    $datas[$row['year']][$row['party_simplified']] += $row['candidatevotes'];
}

foreach ($years as $anno) {
    $total = 0;
    foreach ($parties as $partito) {
        $total += $datas[$anno][$partito];
    }
    foreach ($parties as $partito) {
        $datas[$anno][$partito] = round($datas[$anno][$partito] / $total * 100, 2);
    }
}

$winner = [];

foreach ($years as $anno) {
    $max = 0;
    $winner[$anno] = '';
    foreach ($parties as $partito) {
        if ($datas[$anno][$partito] > $max) {
            $max = $datas[$anno][$partito];
            $winner[$anno] = $max;
        }
    }
}

$sql = 'SELECT DISTINCT state_po FROM election_data WHERE state = :state';

$stmt = $pdo->prepare($sql);

$stmt->execute(['state' => $state]);

$flags = $stmt->fetchAll();

$flag = strtolower($flags[0]['state_po']);


$data = [
    'dictionary' => $datas,
    'parties' => $parties,
    'years' => $years,
    'winner' => $winner,
    'state' => $state,
    'flag' => $flag,
];


echo $templates->render("average", $data);

