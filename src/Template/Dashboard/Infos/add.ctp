<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Info $info
 */

$this->assign('title', 'Add Info');
?>

<header class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M34 24H24v10h10V24zM32 2v4H16V2h-4v4h-2c-2.21 0-3.98 1.79-3.98 4L6 38c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4V10c0-2.21-1.79-4-4-4h-2V2h-4zm6 36H10V16h28v22z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= __('Info') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/infos', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
		</svg>
    </a>
</header>

<?= $this->Form->create($info, ['novalidate', 'class' => 'form']) ?>
    <?php
        $this->Form->setTemplates([
            'inputContainer' => '<div class="input {{type}}{{required}}">{{content}} {{editor}}</div>',
            'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}} {{editor}} {{error}}</div>'
        ]);
        echo $this->Form->control('title', ['autocomplete' => 'off']);
        // echo $this->Form->control('slug');
        echo $this->Form->control('content', [
            'class' => 'hidden',
            'label' => 'Content Markdown',
            'templateVars' => ['editor' => '<div class="editor_top"><a class="editor_btnimage" href="#modal-image">Image</a></div><div id="editor"></div>']
        ]);
        echo $this->Form->control('description', ['rows' => 3]);
        echo $this->Form->control('image', [
            'templateVars' => ['editor' => '<a href="#modal-image" class="btn_right btn_image">Pick</a>']
        ]);
        echo __('<div id="preview" class="show_image"></div>');
        echo __('<a class="remove_image" href="#">Remove</a>');
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
    editor.session.setValue(textarea.val());
    editor.session.on("change", function () {
        textarea.val(editor.getValue());
    });

    // selectize
    $('select').selectize();

    // modal
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
