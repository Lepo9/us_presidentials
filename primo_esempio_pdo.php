<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';
require 'conf/config.php';
//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//Qui ci sarebbe la parte di elaborazione sul modello,
//la M di MVC
//In questo esempio viene creato un vettore nel codice,
//generalmente saranno dei dati estratti da un database

//Accesso ai database con PDO

//Creazione della stringa dsn (Data Source Name)
$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME;

//Creazione della connessione
$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

$stmt = $pdo->query('SELECT state, state_po FROM election_data');

$states = $stmt->fetchAll();

//$partito = 'ALABAMA';
//$anno = '2004';
//$sql = 'SELECT candidate FROM elelction_data WHERE state = :partito AND year = :anno';
//$stmt = $pdo->prepare($sql);
//
//$stmt->execute(['state' => $partito, 'year' => $anno]);
//$candidates = $stmt->fetchAll();

//Per verificare il funzionamento della funzione escape (e) togliere il commento
//al codice qua sotto e togliere la chiamata $this->e($cognome), sostituendola con $cognome nel template
//$cognome = '<script>alert("Questo è un terribile attacco XSS")</script>';
$data = [
    'stati' => $states,
];

echo $templates->render("elenco_stati_us", $data);

