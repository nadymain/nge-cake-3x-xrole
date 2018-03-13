<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

$this->assign('title', 'Users');
?>

<header class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M6 10v28c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4V10c0-2.21-1.79-4-4-4H10c-2.21 0-4 1.79-4 4zm24 8c0 3.32-2.69 6-6 6s-6-2.68-6-6c0-3.31 2.69-6 6-6s6 2.69 6 6zM12 34c0-4 8-6.2 12-6.2S36 30 36 34v2H12v-2z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= __('Users') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/users/add', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
    </a>
</header>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?=__('Name') ?></th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), 
                        ['action' => 'edit', $user->id],
                        ['class' => 'btn']
                    ) ?>
                    <?= $this->Form->postLink(__('Delete'), 
                        ['action' => 'delete', $user->id],
                        ['class' => 'btn', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
                    ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if ($users->isEmpty()) : ?>
    <div class="table_nocontent">
        <p><?php echo __('No users found.'); ?></p> 
    </div>
<?php endif; ?>