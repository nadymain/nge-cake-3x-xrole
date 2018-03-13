<?php
$this->Html->meta(
    'canonical', 
    $this->Url->build('/blog', true), 
    ['rel' => 'canonical', 'type' => null, 'title' => null, 'block' => 'meta']
)
?>

<?= $this->element('Main/bloglist') ?>
