<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting[]|\Cake\Collection\CollectionInterface $settings
 */

$this->assign('title', 'Settings');
?>

<div class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M40 8H8c-2.21 0-4 1.79-4 4v24c0 2.21 1.79 4 4 4h32c2.21 0 4-1.79 4-4V12c0-2.21-1.79-4-4-4zM8 24h8v4H8v-4zm20 12H8v-4h20v4zm12 0h-8v-4h8v4zm0-8H20v-4h20v4z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= $this->fetch('title') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/settings/add', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
    </a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= __('Name') ?></th>
                <th class="hidden_mobile"></th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($settings as $setting): ?>
            <tr>
                <td>
                    <?= h($setting->name) ?>
                </td>
                <td class="hidden_mobile">
                    <?php if ($setting->input_key == 'site_logo' && !$setting->input_value == null) { ?>
                        <?= $this->Html->image($setting->input_value, ['alt' => 'logo']) ?>
                    <?php } else { ?>
                        <?= h($setting->input_value) ?>
                    <?php } ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), 
                        ['action' => 'edit', $setting->id],
                        ['class' => 'btn']
                    ) ?>
                    <!-- <?= $this->Form->postLink(__('Delete'),
                        ['action' => 'delete', $setting->id], 
                        ['class' => 'btn', 'confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]
                    ) ?> -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<?php if ($settings->isEmpty()) : ?>
<div class="table_nocontent">
    <p><?php echo __('No settings found.'); ?></p> 
</div>
<?php endif; ?>
