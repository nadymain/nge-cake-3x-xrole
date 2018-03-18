<?php
$this->assign('title', $article->title);
if ($article->description) {
    $this->Html->meta(
        'description', 
        $article->description, 
        ['block' => 'meta']
    );
}

$this->Html->meta(
    'canonical', 
    $this->Url->build('/blog/', true) . $article->slug, 
    ['rel' => 'canonical', 'type' => null, 'title' => null, 'block' => 'meta']
);

$parsedown = new App\Markdown\Extension();
?>

<article class="article clear">
    <header>
        <?php if ($article->image) : ?>
            <div class="article_image">
                <?= $this->Html->image($article->image, ['alt' => 'Featured Image']) ?>
            </div>
        <?php endif ?>
        <h2 class="article_title">
            <?= $this->Html->link($article->title, [
                'controller' => 'Blog',
                'action' => 'show',
                'slug' => $article->slug
            ]); ?>
        </h2>
        <div class="article_meta">
            <?= h($article->created) ?>
        </div>
    </header>
    <div class="article_content">
        <?= $parsedown->text($article->content) ?>
    </div>
    <footer>
        <div class="article_tag">
            <?php if (!empty($article->tags)) : ?>
                <?php
                    echo __('Tags: ');
                    $total = count($article->tags);
                    $i=0;
                    foreach ($article->tags as $tag) {
                        $i++;
                        echo $this->Html->link($tag->name, [
                            'controller' => 'Blog',
                            'action' => 'tags',
                            'slug' => $tag->slug
                        ]);
                        if ($i != $total) {
                            echo ', ';
                        }
                    }
                ?>
            <?php endif; ?>
        </div>
    </footer>
    <?php if ($this->request->session()->read('Auth.User')) {
        echo $this->Html->link('Edit', 
            ['prefix' => 'dashboard', 'controller' => 'Articles', 'action' => 'edit', $article->id],
            ['class' => 'article_edit']
        );
    } ?>
</article>

<?php echo $this->element('Main/prevnext'); ?>
