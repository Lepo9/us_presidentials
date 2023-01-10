<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';
require 'conf/config.php';


//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//Qui ci sarebbe la parte di elaborazione sul modello,
//la M di MVC
//In questo esempio viene creato un vetto

$candidate = $_GET['candidate'];

$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME;

//Creazione della connessione
$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

//prendo tutti i voti ai partiti dello stato negli anni e lo faccio per i 2 stati
$sql = 'SELECT distinct year FROM election_data WHERE candidate = :candidate';
$stmt = $pdo->prepare($sql);
$stmt->execute(['candidate' => $candidate]);
$list = $stmt->fetchAll();
//contiene gli anni
$years = [];
foreach ($list as $row) {
    $year = $row['year'];
    array_push($years, $year);
}

//contiene chiave:anno, argomento:nome_partito
$parties = [];

foreach ($years as $year) {
    $sql = 'SELECT distinct party_detailed FROM election_data WHERE candidate = :candidate AND year = :year';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['candidate' => $candidate, 'year' => $year]);
    $list = $stmt->fetchAll();
    $parties[$year] = [];
    foreach ($list as $row) {
        $party = $row['party_detailed'];
        array_push($parties[$year], $party);
    }
}

//estrai un array di stati in base al candidato e l'anno
$states = [];
foreach ($years as $year) {
    $sql = 'SELECT distinct state FROM election_data WHERE candidate = :candidate AND year = :year';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['candidate' => $candidate, 'year' => $year]);
    $list = $stmt->fetchAll();
    $states[$year] = [];
    foreach ($list as $row) {
        $state = $row['state'];
        array_push($states[$year], $state);
    }
}

//estrai un array di voti in base al candidato, l'anno e lo stato
$votes = [];
foreach ($years as $year) {
    $votes[$year] = [];
    foreach ($states[$year] as $state) {
        $sql = 'SELECT candidatevotes FROM election_data WHERE candidate = :candidate AND year = :year AND state = :state';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['candidate' => $candidate, 'year' => $year, 'state' => $state]);
        $list = $stmt->fetchAll();
        $votes[$year][$state] = $list[0]['candidatevotes'];
    }
}

$data = [
    'candidate' => $candidate,
    'years' => $years,
    'parties' => $parties,
    'states' => $states,
    'votes' => $votes,
];


echo $templates->render("cdp", $data);
