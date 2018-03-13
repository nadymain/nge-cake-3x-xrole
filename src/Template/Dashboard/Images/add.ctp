<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image $image
 */

$this->assign('title', 'Add Image');
?>

<header class="main_header clear">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
        <path d="M42 38V10c0-2.21-1.79-4-4-4H10c-2.21 0-4 1.79-4 4v28c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4zM17 27l5 6.01L29 24l9 12H10l7-9z"/>
    </svg>
    <h1>
        <span><?= $this->request->getParam('action') ?></span>
        <?= __('Image') ?>
    </h1>
    <a href="<?= $this->Url->build('/dashboard/images', true) ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
		</svg>
    </a>
</header>

<?= $this->Form->create($image, ['novalidate', 'type' => 'file', 'class' => 'form']) ?>
    <?php
        $this->Form->setTemplates([
            'inputContainer' => '<div class="input {{type}}{{required}}">{{content}} {{editor}}</div>',
            'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}}{{editor}}{{error}}</div>'
        ]);
        echo $this->Form->control('file', [
            'type' => 'file',
            'label' => false,
            'templateVars' => ['editor' => '<div class="preview_image"><p class="no_image">Choose a image.</p></div>']
        ]);
        // echo $this->Form->control('dir');
        // echo $this->Form->control('size');
        // echo $this->Form->control('type');
    ?>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

<?php $this->start('inline'); ?>
<script>
$(function() {
    $("#file").on('change', function() {
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $(".preview_image");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "dummy_image",
                        "alt": "dummy"
                    }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
            }
        } else {
            image_holder.show();
            image_holder.append("<p class='no_image'>Oops! Please select image.</p>");
        }
    });
});
</script>
<?php $this->end(); ?>
