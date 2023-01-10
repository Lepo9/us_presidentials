<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $questions
 * @var $first_description
 */
?>

<?php $this->layout('home', ['titolo' => 'Questions', 'first_description' => $first_description]) ?>

<h2>Here you can find the Frequently Asked Questions </h2>

<ul>
    <?php foreach ($questions as $question): ?>
        <li><a href=<?= $question['link'] ?>> <?= $question['question'] ?></a></li>
    <?php endforeach; ?>
</ul>

<div class="divider"></div>
