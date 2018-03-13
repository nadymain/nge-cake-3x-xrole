<?php
$this->assign('title', $info->title);
if ($info->description) {
    $this->Html->meta(
        'description', 
        $info->description, 
        ['block' => 'meta']
    );
}
$this->Html->meta(
    'canonical', 
    $this->Url->build('/info/', true) . $info->slug, 
    ['rel' => 'canonical', 'type' => null, 'title' => null, 'block' => 'meta']
);
$parsedown = new Parsedown();
?>

<article class="article clear">
    <header>
        <?php if ($info->image) : ?>
            <div class="article_image">
                <?= $this->Html->image($info->image, ['alt' => 'Featured Image']) ?>
            </div>
        <?php endif ?>
        <h2 class="article_title">
            <?= $this->Html->link($info->title, [
                'controller' => 'Info',
                'action' => 'show',
                'slug' => $info->slug
            ]); ?>
        </h2>
    </header>
    <div class="article_content">
        <?= $parsedown->text($info->content) ?>
    </div>
    <?php if ($this->request->session()->read('Auth.User')) {
        echo $this->Html->link('Edit', 
            [
                'prefix' => 'dashboard', 
                'controller' => 'Infos', 
                'action' => 'edit', 
                $info->id
            ],
            ['class' => 'article_edit']
        );
    } ?>
</article>