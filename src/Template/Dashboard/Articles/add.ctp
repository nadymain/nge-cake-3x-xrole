<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */

$this->assign('title', 'Add Article');
?>

<header class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M28 4H12C9.79 4 8.02 5.79 8.02 8L8 40c0 2.21 1.77 4 3.98 4H36c2.21 0 4-1.79 4-4V16L28 4zm4 32H16v-4h16v4zm0-8H16v-4h16v4zm-6-10V7l11 11H26z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= __('Article') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/articles', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
		</svg>
    </a>
</header>

<?= $this->Form->create($article, ['novalidate', 'class' => 'form']) ?>
    <?php
        $this->Form->setTemplates([
            'inputContainer' => '<div class="input {{type}}{{required}}">{{content}} {{editor}}</div>',
            'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}} {{editor}} {{error}}</div>'
        ]);
        echo $this->Form->control('title', ['autocomplete' => 'off']);
        echo $this->Form->control('content', [
            'class' => 'hidden',
            'label' => 'Content Markdown',
            'templateVars' => ['editor' => '<div class="editor_top"><a class="editor_btnimage" href="#modal-image">Image</a></div><div id="editor"></div>']
        ]);
        echo $this->Form->control('description', ['rows' => 3]);
        echo $this->Form->control('tag_string');
        echo $this->Form->control('image', [
            'templateVars' => ['editor' => '<a href="#modal-image" class="btn_right btn_image">Pick</a>']
        ]);
        echo __('<div id="preview" class="show_image"></div>');
        echo __('<a class="remove_image" href="#">Remove</a>');
        echo $this->Form->control('created');
        echo $this->Form->control('status', ['options' => [0 => 'Draft', 1 => 'Published']]);
    ?>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

<?= $this->element('Dashboard/modal-image') ?>

<?php
    $this->Html->script('/assets/ace/ace.js', ['block' => true]);
    $this->Html->script('/assets/selectize/selectize.js', ['block' => true]);
    $this->Html->css('/assets/selectize/selectize.css', ['block' => true]);
    $this->Html->script('/assets/modal/jquery.modal.js', ['block' => true]);
    $this->Html->css('/assets/modal/jquery.modal.css', ['block' => true]);
?>

<?php $this->start('inline'); ?>
<script>
$(function() {
    // ace
    var editor = ace.edit('editor');
    var textarea = $('textarea[name="content"]');
    editor.session.setMode("ace/mode/markdown");
    editor.session.setValue($("#content").val());
    editor.session.on("change", function () {
        textarea.val(editor.getValue());
    });

    // selectize
    $('select').selectize();
    
    var tags = [
        <?php foreach ($tags as $tag): ?>
            {value: '<?= $tag->name ?>', text: '<?= $tag->name ?>'},
        <?php endforeach; ?>
    ];
    $('#tag-string').selectize({
        plugins: ['remove_button'],
        maxItems: 4,
        delimiter: ', ',
        options: tags,
        create: true,
    });

    // modal image
    var base_url = '<?= $this->Url->build('/', true) ?>';
    $('.btn_image').on('click', function(e){
        e.preventDefault();
        $('#modal-image').find('.content').html('<iframe src="' + base_url + 'dashboard/images/iframe?type=modal"></iframe>');
        $(this).modal();
    });

    $('.editor_btnimage').on('click', function(e){
        e.preventDefault();
        $('#modal-image').find('.content').html('<iframe src="' + base_url + 'dashboard/images/iframe?type=editor"></iframe>');
        $(this).modal();
    });

    $('.remove_image').on('click', function(e) {
        e.preventDefault();
        $('.show_image, .remove_image').css('display', 'none');
        $('#image').val('');
    });
});
</script>
<?php $this->end(); ?>
