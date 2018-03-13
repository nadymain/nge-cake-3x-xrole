<header class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M42 38V10c0-2.21-1.79-4-4-4H10c-2.21 0-4 1.79-4 4v28c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4zM17 27l5 6.01L29 24l9 12H10l7-9z"/>
    </svg>
    <h1>
        <span><?= __('Index') ?></span>
        <?= __('Images') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/images/addiframe', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
    </a>
</header>

<div class="main_middle main_middle_image clear">
    <div class="status">
        <?= $this->Html->link('All (' . $total . ')', 
            ['action' => 'iframe'],
            ['class' => (!$this->request->getQuery()) ? 'active' : 'inactive'] 
        ); ?>
    </div>
    
    <?php
        echo $this->Form->create(null, ['valueSources' => 'query']);
            echo $this->Form->input('filter', [
                'placeholder' => 'File...',
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
                <th><?= $this->Paginator->sort('file', 'Images') ?></th>
                <th width="90"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $image): ?>
            <tr>
                <td>
                    <?= $this->Html->image('uploads/'. $image->dir .'/thumb150-'. $image->file, 
                        ['alt' => 'thumb', 'title' => $image->file]
                    ) ?>
                </td>
                <td>
                    <?= $this->Html->link(__('Select'), '#',
                        ['data-url' =>  'uploads/'.$image->dir.'/'.$image->file, 'class' => 'btn select']
                    ) ?>
                    <?= $this->Form->postLink(__('Delete'), 
                        ['action' => 'delete', $image->id], 
                        ['class' => 'btn', 'confirm' => __('Are you sure you want to delete # {0}?', $image->id)]
                    ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if ($images->isEmpty()) : ?>
    <div class="table_nocontent">
        <p><?php echo __('No images found.'); ?></p> 
    </div>
<?php endif; ?>

<?= $this->element('Dashboard/paginator') ?>

<?php $this->start('inline'); ?>
<script>

    // select
    var base_img = '<?= $this->Url->build('/img/', true) ?>';
    $('.select').on('click', function(e) {
        e.preventDefault();
        parent.document.getElementById('image').value = $(this).data('url');
        parent.document.getElementById('preview').innerHTML = '<img alt="show image" src="' + base_img + $(this).data('url') + '">';
        parent.$('.show_image, .remove_image').css('display', 'block');
        parent.$.modal.close();
    });

    // search
	function loadPageVar(sVar) {
		return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
	}
	var searchTitle = loadPageVar('filter');
	if (!!searchTitle) {
		$(".main_middle .status").after("<span class='search_result'>Search results for &#8220;" + searchTitle + "&#8221;</span>");
	}
</script>
<?php $this->end(); ?>
