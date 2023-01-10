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

$state1 = $_POST['first'];
$state2 = $_POST['second'];

$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME;

//Creazione della connessione
$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

//prendo tutti i voti ai partiti dello stato negli anni e lo faccio per i 2 stati

$sql = 'SELECT year, party_simplified, candidatevotes FROM election_data WHERE state = :state';
$stmt = $pdo->prepare($sql);
$stmt->execute(['state' => $state1]);
$list1 = $stmt->fetchAll();
$stmt->execute(['state' => $state2]);
$list2 = $stmt->fetchAll();

$stmt = $pdo->query('SELECT DISTINCT party_simplified FROM election_data');
$list = $stmt->fetchAll();

$parties = []; //ci sono tutti i partiti
foreach ($list as $partito) {
    array_push($parties, $partito['party_simplified']);
}

//creazione dell'array principale
//salvo in un array la somma dei voti per ogni partito complessivamente
$votes = [];
foreach ($parties as $partito) {
    $votes[$partito] = [
        'first' => 0,
        'second' => 0
    ];
}

foreach ($list1 as $row) {
    $votes[$row['party_simplified']]['first'] += $row['candidatevotes'];
}
foreach ($list2 as $row) {
    $votes[$row['party_simplified']]['second'] += $row['candidatevotes'];
}

//prendo tutti i canditati e me li salvo con gli anni
$sql = 'SELECT year, candidate FROM election_data WHERE state = :state';
$stmt = $pdo->prepare($sql);
$stmt->execute(['state' => $state1]);
$list1 = $stmt->fetchAll();
$stmt->execute(['state' => $state2]);
$list2 = $stmt->fetchAll();

$stmt = $pdo->query('SELECT DISTINCT year FROM election_data');
$list = $stmt->fetchAll();
$years = []; //ci sono tutti gli anni
foreach ($list as $anno) {
    array_push($years, $anno['year']);
}

$candidates1 = [];
$candidates2 = [];

foreach ($years as $anno) {
    $candidates1[$anno] = [];
    $candidates2[$anno] = [];
}

foreach ($list1 as $row) {
    if ($row['candidate'] != '') {
        array_push($candidates1[$row['year']], $row['candidate']);
    }

}
foreach ($list2 as $row) {
    if ($row['candidate'] != '') {
        array_push($candidates2[$row['year']], $row['candidate']);
    }
}

$candidates = [];

foreach ($years as $anno) {
    $candidates[$anno] = [
        'first' => [],
        'second' => [],
        'both' => []
    ];
    foreach ($candidates1[$anno] as $candidato) {
        if (in_array($candidato, $candidates2[$anno])) {
            array_push($candidates[$anno]['both'], $candidato);
        } else {
            array_push($candidates[$anno]['first'], $candidato);
        }
    }
    foreach ($candidates2[$anno] as $candidato) {
        if (!in_array($candidato, $candidates1[$anno])) {
            array_push($candidates[$anno]['second'], $candidato);
        }
    }

}

//var_dump($candidates);

$data = [
    'votes' => $votes,
    'candidates' => $candidates,
    'parties' => $parties,
    'state1' => $state1,
    'state2' => $state2,
    'years' => $years
];


echo $templates->render("comparison", $data);

