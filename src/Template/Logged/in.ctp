<?php
$this->assign('title', 'Login');
$this->Html->meta('robots', 'noindex', [
    'block' => 'meta'
]);
?>

<article class="article clear">
    <?= $this->Form->create(null, ['class' => 'box_form']) ?>
    <legend>Login</legend>

        <?= $this->Form->control('username', ['required']) ?>
        <?= $this->Form->control('password', ['required']) ?>
        
    <?= $this->Form->button('Submit') ?>
    <?= $this->Form->end() ?>
</article>
