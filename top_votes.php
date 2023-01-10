<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';

//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates','tpl');

//Qui ci sarebbe la parte di elaborazione sul modello,
//la M di MVC
//In questo esempio sono solo degli assegnamenti
$nome = 'Alessandro';
$cognome = 'Bugatti';
//Per verificare il funzionamento della funzione escape (e) togliere il commento
//al codice qua sotto e togliere la chiamata $this->e($cognome), sostituendola con $cognome nel template
//$cognome = '<script>alert("Questo è un terribile attacco XSS")</script>';
$data = [
    'nome' => $nome,
    'cognome' => $cognome
];

echo $templates->render("saluti", $data);

