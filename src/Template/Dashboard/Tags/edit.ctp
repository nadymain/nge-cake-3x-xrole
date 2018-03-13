<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */

$this->assign('title', 'Edit Tag');
?>

<header class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M5.06 39.31l2.69 1.11V22.37L2.9 34.08c-.84 2.03.13 4.38 2.16 5.23zm39-7.42L34.14 7.96c-.62-1.5-2.08-2.43-3.61-2.46-.53-.01-1.07.09-1.6.3L14.2 11.9c-1.5.62-2.42 2.07-2.46 3.6-.01.54.08 1.08.3 1.61l9.91 23.93c.63 1.52 2.1 2.44 3.66 2.46.52 0 1.04-.09 1.55-.3l14.73-6.1c2.03-.84 3.01-3.18 2.17-5.21zM15.75 17.5c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm-4 22c0 2.2 1.8 4 4 4h2.91l-6.91-16.68V39.5z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= __('Tag') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/tags', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
		</svg>
    </a>
</header>

<?= $this->Form->create($tag, ['novalidate', 'class' => 'form']) ?>
    <?php
        echo $this->Form->control('name', ['autocomplete' => 'off']);
        // echo $this->Form->control('slug');
        echo $this->Form->control('description');
        // echo $this->Form->control('articles._ids', ['options' => $articles]);
    ?>
<?= $this->Form->button(__('Update')) ?>
<?php if ($tag->article_count !== '0') {
    echo $this->Html->link('View', [
        'prefix' => false,
        'controller' => 'Blog',
        'action' => 'tags',
        'slug' => $tag->slug
    ], [
        'class' => 'btn_view'
    ]);
} ?>
<?= $this->Form->end() ?>
