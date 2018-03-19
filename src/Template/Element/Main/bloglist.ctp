<?php $parsedown = new ParsedownExtra() ?>

<?php if (!$articles->isEmpty()) : ?>
    <?php foreach ($articles as $article): ?>
    <article class="article clear">
        <header>
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
        <p class="article_content">
            <?php
                $content = $parsedown->text($article->content);
                $content = h(strip_tags($content));
                echo $this->Text->truncate($content, 380, [
                    'ending' => '...',
                    'exact' => true,
                    'html' => true
                ]);
            ?>
        </p>
        <?php if ($this->request->session()->read('Auth.User')) {
            echo $this->Html->link('Edit', 
                ['prefix' => 'dashboard', 'controller' => 'Articles', 'action' => 'edit', $article->id],
                ['class' => 'article_edit']
            );
        } ?>
    </article>
    <?php endforeach ?>
<?php else : ?>
    <article class="article article_notfound">
		<p><?php echo __('No articles found.'); ?></p>
	</article>
<?php endif ?>

<?= $this->element('Main/paginator') ?>
