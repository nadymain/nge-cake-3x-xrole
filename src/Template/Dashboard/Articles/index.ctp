<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */

$this->assign('title', 'Articles');
?>

<div class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M28 4H12C9.79 4 8.02 5.79 8.02 8L8 40c0 2.21 1.77 4 3.98 4H36c2.21 0 4-1.79 4-4V16L28 4zm4 32H16v-4h16v4zm0-8H16v-4h16v4zm-6-10V7l11 11H26z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= $this->fetch('title') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/articles/add', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
    </a>
</div>

<div class="main_middle clear">
    <div class="status">
        <?= $this->Html->link('All (' . $total . ')', 
            ['action' => 'index'],
            ['class' => (!$this->request->getQuery()) ? 'active' : 'inactive'] 
        ); ?>
        <?= $this->Html->link('Published (' . $publish . ')', 
            ['action' => 'index?status=1'],
            ['class' => ($this->request->getQuery('status') == '1') ? 'active' : 'inactive']
        ); ?>
        <?= $this->Html->link('Draft (' . $draft . ')', 
            ['action' => 'index?status=0'],
            ['class' => ($this->request->getQuery('status') == '0') ? 'active' : 'inactive']
        ); ?>
    </div>
    
    <?php
        echo $this->Form->create(null, ['valueSources' => 'query', 'class' => 'hidden_mobile']);
            echo $this->Form->input('tag_id', [
                'options' => $tags, 
                'empty' => ' - Tag - ',
                'templates' => ['inputContainer' => '{{content}}'],
                'label' => false
            ]);
            echo $this->Form->input('filter', [
                'placeholder' => 'Title...',
                'templates' => ['inputContainer' => '{{content}}'],
                'label' => false
            ]);
        echo $this->Form->button('Filter', ['type' => 'submit']);
        echo $this->Form->end();
    ?>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th width="130" class="hidden_mobile"><?= __('Tags') ?></th>
                <th width="90" class="hidden_mobile"><?= $this->Paginator->sort('status') ?></th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td>
                    <h2>
                        <?php if ($article->status == '1') {
                            echo $this->Html->link($article->title, [
                                'prefix' => false,
                                'controller' => 'Blog',
                                'action' => 'show',
                                'slug' => $article->slug
                            ]);
                        } else {
                            echo h($article->title);
                        } ?>
                    </h2>
                    <span><?= $this->Paginator->sort('created') ?>: <?= h($article->created) ?></span>
                    <span><?= $this->Paginator->sort('modified') ?>: <?= h($article->modified) ?></span>
                </td>
                <td class="hidden_mobile">                        
                    <ul class="tags">
                        <?php if (!empty($article->tags)) {
                            foreach ($article->tags as $tags) {
                                echo __('<li>' . $this->Html->link($tags->name, '?tag_id=' . $tags->id) . '</li>');
                            }
                        } ?>
                    </ul>
                </td>
                <td class="hidden_mobile">
                    <?= $this->MyUpdate->status($article->status, $article->id) ?>
                </td>
                <td>
                    <?= $this->Html->link(__('Edit'), 
                        ['action' => 'edit', $article->id],
                        ['class' => 'btn']
                    ) ?>
                    <?= $this->Form->postLink(__('Delete'), 
                        ['action' => 'delete', $article->id], 
                        ['class' => 'btn', 'confirm' => __('Are you sure you want to delete # {0}?', $article->id)]
                    ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if ($articles->isEmpty()) : ?>
<div class="table_nocontent">
    <p><?php echo __('No articles found.'); ?></p> 
</div>
<?php endif; ?>

<?= $this->element('Dashboard/paginator') ?>

<?php
    $this->Html->script('/assets/selectize/selectize.js', ['block' => true]);
    $this->Html->css('/assets/selectize/selectize.css', ['block' => true]);
?>

<?php $this->start('inline'); ?>
<script>
$(function() {
    $('select').selectize({
        allowEmptyOption: true
    });

    // search
	function loadPageVar(sVar) {
		return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
	}
	var searchTitle = loadPageVar('filter');
	if (!!searchTitle) {
		$(".main_middle .status").after("<span class='search_result'>Search results for &#8220;" + searchTitle + "&#8221;</span>");
	}
});
</script>
<?php $this->end(); ?>
