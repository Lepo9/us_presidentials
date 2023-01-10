<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $candidate
 * @var $years
 * @var $parties
 * @var $states
 * @var $votes
 */
?>

<?php

$this->layout('home',
    [
        'titolo' => 'Questions',
        'first_description' => 'This is ' . $candidate,
        'second_description' => 'Here you can find for which parties he participated in the elections'
    ]) ?>

<div class="divider"></div>


<?php foreach ($years as $year): ?>
    <h3><?= $year ?> - <?= $parties[$year][0] ?></h3>
    <table class="table table-striped table-hover">
        <tr class="text-center">
            <th>State</th>
            <th>Votes</th>
        </tr>
        <?php foreach ($states[$year] as $state): ?>
            <tr class="text-center">
                <td><?= $state ?></td>
                <td><?= $votes[$year][$state] ?></td>
            </tr>

        <?php endforeach; ?>

    </table>
    <div class="divider"></div>
<?php endforeach; ?>

<div class="divider"></div>
