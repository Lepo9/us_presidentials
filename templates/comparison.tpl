<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $votes
 * @var $candidates
 * @var $state1
 * @var $state2
 * @var $years
 * @var $parties
 */
?>

<?php

$state1 = strtolower($state1);
$state1 = ucfirst($state1);
$state2 = strtolower($state2);
$state2 = ucfirst($state2);

$this->layout('home',
    [
        'titolo' => 'Questions',
        'first_description' => 'Analysis of two states',
        'second_description' => 'There is the differences between ' . $state1 . ' and ' . $state2,
    ]) ?>

<div class="divider"></div>

<p>Here is the comparison between the votes. Below it is shown the sum of votes for each party in history for the two
    states</p>
<table class="table table-striped table-hover">
    <tr class="text-center">
        <th><?= $state1 ?></th>
        <th>Party</th>
        <th><?= $state2 ?></th>
    </tr>
    <?php foreach ($parties as $party): ?>
        <tr class="text-center">
            <td><?= $votes[$party]['first'] ?></td>
            <td><?= $party ?></td>
            <td><?= $votes[$party]['second'] ?></td>
        </tr>
    <?php endforeach; ?>
    <tr class="text-center">
        <th></th>
        <th></th>
        <th></th>
    </tr>
</table>

<div class="divider"></div>
<div class="divider"></div>

<p>Here is the comparison between the candidates in each state. Below it is shown
    if the candidates of each state in history were candidate also in the other. </p>

<table class="table table-striped table-hover">
    <tr class="text-center">
        <th><h1><?= $state1 ?></h1></th>
        <th>
            <h1>Both</h1>
        </th>
        <th><h1><?= $state2 ?></h1></th>
    </tr>
    <?php foreach ($years as $year): ?>
        <tr class="text-center">
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr class="text-center">
            <td></td>
            <th><?= $year ?></th>
            <td></td>
        </tr>

        <?php foreach ($candidates[$year]['both'] as $candidate): ?>
            <tr class="text-center">
                <td></td>
                <td><?= $candidate ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($candidates[$year]['first'] as $candidate): ?>
            <tr class="text-center">
                <td><?= $candidate ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($candidates[$year]['second'] as $candidate): ?>
            <tr class="text-center">
                <td></td>
                <td></td>
                <td><?= $candidate ?></td>
            </tr>
        <?php endforeach; ?>

    <?php endforeach; ?>

</table>


<div class="divider"></div>
