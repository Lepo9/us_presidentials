<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $states
 * @var $flags
 */
?>

<?php $this->layout('home',
    [
        'titolo' => 'Questions',
        'first_description' => 'Analysis of votes for parties in one state during years',
        'second_description' => 'Select the state'
    ]); ?>

<div class="divider"></div>


<div class="columns">
    <?php
    $counter = 0;
    foreach ($states as $state): ?>
        <div class="column col-4">
            <a href="average.php?state=<?= $state['state'] ?>"><?= $state['state'] ?></a>
            <img src="https://flagcdn.com/40x30/us-<?= $flags[$counter] ?>.png" alt="">
            <?php $counter++; ?>
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
