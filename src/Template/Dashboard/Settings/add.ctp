<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting $setting
 */

$this->assign('title', 'Add Setting');
?>

<header class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M40 8H8c-2.21 0-4 1.79-4 4v24c0 2.21 1.79 4 4 4h32c2.21 0 4-1.79 4-4V12c0-2.21-1.79-4-4-4zM8 24h8v4H8v-4zm20 12H8v-4h20v4zm12 0h-8v-4h8v4zm0-8H20v-4h20v4z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= __('Setting') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/settings', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
		</svg>
    </a>
</header>

<?= $this->Form->create($setting, ['novalidate', 'class' => 'form']) ?>
    <?php
        echo $this->Form->control('name');
        echo $this->Form->control('input_key');
        echo $this->Form->control('input_value');
        echo $this->Form->control('input_type');
    ?>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

