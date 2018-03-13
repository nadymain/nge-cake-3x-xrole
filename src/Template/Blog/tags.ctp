<?php
$this->assign('title', $tag->name);
$this->Html->meta(
    'canonical', 
    $this->Url->build('/blog/tagged/', true) . $tag->slug, 
    ['rel' => 'canonical', 'type' => null, 'title' => null, 'block' => 'meta']
);
if ($tag->description) {
    $this->Html->meta(
        'description',
        $tag->description, 
        ['block' => 'meta']
    );
}
?>
<div class="head_article">
    <h2>
        <?php 
            echo __('Tag: ');
            echo $this->Html->link($tag->name, [
                'controller' => 'Blog',
                'action' => 'tags',
                'slug' => $tag->slug
            ]); 
        ?>
	</h2>
	<?php if ($tag->description) : ?>
    <p>
        <?= h($tag->description); ?>
    </p>
	<?php endif ?>
</div>

<?= $this->element('Main/bloglist') ?>
