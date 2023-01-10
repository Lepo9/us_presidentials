<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $titolo
 * @var $first_description
 * @var $second_description
 */
?>
<html lang="it">
<head>
    <link rel="stylesheet" href="../css/spectre.min.css">
    <link rel="stylesheet" href="../css/spectre-exp.min.css">
    <link rel="stylesheet" href="../css/spectre-icons.min.css">
    <title><?= $this->e($titolo) ?></title>
</head>
<body class="container"
      style="background-image: url('img/background.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; ">
<div class="container bg-gray grid-xl">

    <div class="divider"></div>

    <header class="navbar">
        <section class="navbar-section">
            <div class="container">
                <div class="columns">
                    <div class="column col-1 col-ml-auto">
                        <div class="columns">
                            <div class="column col-5 col-ml-auto">
                                <a href="index.php">
                                    <img src="img/home.png" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="columns">
        <div class="column col-10 col-mx-auto">
            <h2><?= $this->e($first_description) ?></h2>
            <div class="container">
                <div class="columns">
                    <div class="column col-6 col-mx-auto">
                        <figure class="figure">
                            <a href="img/usa.jpg" target="_blank">
                                <img src="img/usa.jpg" class="img-responsive img-fit-cover" alt="USA map">
                            </a>
                            <figcaption class="figure-caption text-center">Tap to zoom!</figcaption>
                        </figure>

                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <!--Questa parte sarà sempre così e serve a includere
            il template che contiene il contenuto vero e proprio-->
            <h4><?= $this->e($second_description) ?></h4>
            <?= $this->section('content') ?>
            <div class="divider"></div>
        </div>

    </div>
</body>
</html>
