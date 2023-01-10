<?php
/**
 * Questo commento serve solo a eliminare l'indicazione di errore
 * da parte di PHPStorm per la variabile $studenti
 * @var $states
 */
?>

<?php $this->layout('home',
    [
        'titolo' => 'Questions',
        'first_description' => 'Analysis of votes for parties in one state during years',
        'second_description' => ''
    ]) ?>

<div class="divider"></div>

<form action="comparison.php" method="post">
    <div class="form-group">
        <label class="form-label" for="input-example-1">Select the first State</label>
        <select class="form-select" name="first" id="input-example-1">
            <?php foreach ($states as $state): ?>
                <option><?= $state['state'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label" for="input-example-2">Select the second State</label>
        <select class="form-select" name="second" id="input-example-2">
            <?php foreach ($states as $state): ?>
                <option><?= $state['state'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="columns">
        <div class="column col-2 col-mx-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>


<div class="divider"></div>
