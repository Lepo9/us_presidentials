<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $dictionary
 * @var $years
 * @var $parties
 * @var $first_description
 * @var $second_description
 * @var $winner
 */
?>

<?php $this->layout('home',
    [
        'titolo' => 'Questions',
        'first_description' => 'Analysis of the trend of votes for parties in history',
        'second_description' => 'There is the list of the years with the percent of votes for every party',
    ]) ?>

<i>If a party has the most of the votes doesn't mean that that party won in that year</i>

<table class="table table-striped table-hover">
    <tr class="text-center">
        <th>Year</th>
        <?php foreach ($parties as $party): ?>
            <th><?= $party ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($years as $year): ?>
        <tr class="text-center">
            <td><?= $year ?></td>
            <?php foreach ($dictionary[$year] as $party): ?>
                <td
                    <?php if ($party == $winner[$year]): ?>
                        <?= ' class="bg-success"' ?>
                    <?php endif; ?>
                ><?= $party ?>%
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>


<div class="divider"></div>
