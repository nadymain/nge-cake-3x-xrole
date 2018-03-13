<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu[]|\Cake\Collection\CollectionInterface $menus
 */

$this->assign('title', 'Menus');
?>

<div class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M4 40h40v-8H4v8zm4-6h4v4H8v-4zM4 8v8h40V8H4zm8 6H8v-4h4v4zM4 28h40v-8H4v8zm4-6h4v4H8v-4z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= $this->fetch('title') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/menus/add', true) ?>">
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
                <th class="hidden_mobile"><?= __('Link') ?></th>
                <th width="80" class="hidden_mobile"><?= __('Move') ?></th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
            <tr>
                <td>
                    <?php if ($menu->has('parent_menu')) {
                        echo $this->Html->link('— ' .  $menu->name, $menu->link);
                    } else {
                        echo $this->Html->link($menu->name, $menu->link);
                    } ?>
                </td>
                <td class="hidden_mobile">
                    <?= h($menu->link) ?>
                </td>
                <td class="hidden_mobile">
                    <?= $this->Form->postLink('Up',
                        ['action' => 'moveUp', $menu->id],
                        ['class' => 'btn up']
                    ) ?>
                    <?= $this->Form->postLink('Down',
                        ['action' => 'moveDown', $menu->id],
                        ['class' => 'btn down']
                    ) ?> 
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), 
                        ['action' => 'edit', $menu->id],
                        ['class' => 'btn']
                    ) ?>
                    <?= $this->Form->postLink(__('Delete'), 
                        ['action' => 'delete', $menu->id], 
                        ['class' => 'btn', 'confirm' => __('Are you sure you want to delete # {0}?', $menu->id)
                    ]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if ($menus->isEmpty()) : ?>
<div class="table_nocontent">
    <p><?php echo __('No menus found.'); ?></p> 
</div>
<?php endif; ?>
