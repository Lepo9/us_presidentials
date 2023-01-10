<?php
//Questo è il controller

//Questa serve per il caricamento delle librerie
require 'vendor/autoload.php';

//L'oggetto che poi si occuperà di gestire il template
$templates = new League\Plates\Engine('templates', 'tpl');

//Qui ci sarebbe la parte di elaborazione sul modello,
//la M di MVC
//In questo esempio viene creato un vetto

$domande = [
    [
        'question' => 'Trend of votes in history ', //elenco degli anni con percentuali ad ogni partito
        'link' => 'trend.php'
    ],
    [
        'question' => 'Average vote for parties in one state',//voto medio ai partiti in uno stato
        'link' => 'average_form.php'
    ],
    [
        'question' => 'Comparison between two states', //confronto di due sati
        //la media dei voti per partito, lista dei passati presidenti con rispettivi partiti
        'link' => 'comparison_form.php'
    ],
    [
        'question' => 'Wiew one candidate', //lista dei candidati
        //incluso nome, nome partito e numero di mandato
        'link' => 'cdf.php'
    ],
];
//Per verificare il funzionamento della funzione escape (e) togliere il commento
//al codice qua sotto e togliere la chiamata $this->e($cognome), sostituendola con $cognome nel template
//$cognome = '<script>alert("Questo è un terribile attacco XSS")</script>';
$data = [
    'questions' => $domande,
];

echo $templates->render("index", $data);

