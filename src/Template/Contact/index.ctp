<?php
$this->assign('title', 'Contact');
$this->Html->meta('robots', 'noindex', [
    'block' => 'meta'
]);
$this->Html->meta('canonical', 
    $this->Url->build('/contact', true), 
    ['rel' => 'canonical', 'type' => null, 'title' => null, 'block' => 'meta']
);
?>

<article class="article clear">
    <?= $this->Form->create($contact, ['novalidate', 'class' => 'box_form']) ?>
        <legend>Contact</legend>
        <?= $this->Form->control('name') ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('message') ?>
    <?= $this->Form->button('Submit') ?>
    <?= $this->Form->end() ?>
</article>
