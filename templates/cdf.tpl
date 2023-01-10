<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $candidates
 */
?>

<?php $this->layout('home',
    [
        'titolo' => 'Questions',
        'first_description' => 'Informations about one andidate',
        'second_description' => 'Select the candidate'
    ]); ?>

<div class="divider"></div>


<div class="columns">

    <?php
    foreach ($candidates as $candidate): ?>
        <div class="column col-4">
            <a href="cdp.php?candidate=<?= $candidate ?>"><?= $candidate ?></a>
        </div>
    <?php endforeach; ?>
</div>


<?php
/**
 * <form action="average.php" method="post">
 * <div class="form-group">
 * <select class="form-select">
 * <?php foreach ($states as $state): ?>
 * <option value=<?= $state['state'] ?>><?= $state['state'] ?></option>
 * <?php endforeach; ?>
 * </select>
 * </div>
 *
 * <div class="columns">
 * <div class="column col-2 col-mx-auto">
 * <button type="submit" class="btn btn-primary">Submit</button>
 * </div>
 * </div>
 * </form>
 */
?>


<div class="divider"></div>
