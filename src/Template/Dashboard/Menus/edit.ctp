<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
$this->assign('title', 'Edit Menus');
?>

<div class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M4 40h40v-8H4v8zm4-6h4v4H8v-4zM4 8v8h40V8H4zm8 6H8v-4h4v4zM4 28h40v-8H4v8zm4-6h4v4H8v-4z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= __('Menu') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/menus', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
		</svg>
    </a>
</div>

<?= $this->Form->create($menu, ['novalidate', 'class' => 'form']) ?>
    <?php
        echo $this->Form->control('name', ['autocomplete' => 'off']);
        echo $this->Form->control('link', ['autocomplete' => 'off']);
        echo $this->Form->control('parent_id', ['options' => $parentMenus, 'empty' => 'No parent menu']);
    ?>
<?= $this->Form->button(__('Update')) ?>
<?= $this->Form->end() ?>

<?php
    $this->Html->script('/assets/selectize/selectize.js', ['block' => true]);
    $this->Html->css('/assets/selectize/selectize.css', ['block' => true]);
?>

<?php $this->start('inline'); ?>
<script>
$(function() {
    // selectize
    $('select').selectize({
        allowEmptyOption: true
    });
});
</script>
<?php $this->end(); ?>