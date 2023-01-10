<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $stati
 * @var $anni
 * @var $flags
 */
?>

<?php $this->layout('home', ['titolo' => 'Elenco candidati']) ?>

<h1>Richiedi i dati dei candidati</h1>

<form action="candidates_by_state_year.php" method="post">
    <select name="states">
        <?php
        $counter = 0;
        foreach ($stati as $stato): ?>
            <option>
                <?= $stato['state'] ?>
                <img src="https://flagcdn.com/40x30/us-<?= $flags[$counter] ?>.png" alt="">
            </option>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </select>
    <br>
    <select name="years">
        <?php foreach ($anni as $anno): ?>
            <option><?= $anno['year'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit">
</form>

