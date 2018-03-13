<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Info[]|\Cake\Collection\CollectionInterface $infos
 */
$this->assign('title', 'Infos');
?>

<div class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M34 24H24v10h10V24zM32 2v4H16V2h-4v4h-2c-2.21 0-3.98 1.79-3.98 4L6 38c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4V10c0-2.21-1.79-4-4-4h-2V2h-4zm6 36H10V16h28v22z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= $this->fetch('title') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/infos/add', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
    </a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th width="90" class="hidden_mobile"><?= $this->Paginator->sort('status') ?></th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($infos as $info): ?>
            <tr>
                <td>
                    <h2>
                        <?php if ($info->status == '1') {
                            echo $this->Html->link($info->title, [
                                'prefix' => false,
                                'controller' => 'Info',
                                'action' => 'show',
                                'slug' => $info->slug
                            ]);
                        } else {
                            echo h($info->title);
                        } ?>
                    </h2>
                </td>
                <td class="hidden_mobile">
                    <?= $this->MyUpdate->status($info->status, $info->id) ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), 
                        ['action' => 'edit', $info->id],
                        ['class' => 'btn']
                    ) ?>
                    <?= $this->Form->postLink(__('Delete'), 
                        ['action' => 'delete', $info->id], 
                        ['class' => 'btn', 'confirm' => __('Are you sure you want to delete # {0}?', $info->id)]
                    ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if ($infos->isEmpty()) : ?>
<div class="table_nocontent">
    <p><?php echo __('No infos found.'); ?></p> 
</div>
<?php endif; ?>

<?= $this->element('Dashboard/paginator') ?>
