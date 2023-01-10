<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $questions
 */
?>

<?php $this->layout('home',
    [
        'titolo' => 'Questions',
        'first_description' => 'Welcome to website about the elections in USA!',
        'second_description' => 'Here you can find the Faq'
    ]) ?>

<ul>
    <?php foreach ($questions as $question): ?>
        <li><a href=<?= $question['link'] ?>> <?= $question['question'] ?></a></li>
    <?php endforeach; ?>
</ul>

<div class="divider"></div>
