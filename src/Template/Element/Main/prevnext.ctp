<div class="prevnext clear">
    <?php if ($prev): ?>
        <?= $this->Html->link(
            '&#10229;', 
            [
                'controller' => 'Blog',
                'action' => 'show',
                'slug' => $prev->slug
            ],
            [
                'escape' => false, 
                'class' => 'prevnext_prev', 
                'title' => $prev->title, 
                'rel' => 'prev'
            ]
        ); ?>
    <?php endif; ?>
    
    <?php if ($next): ?>
        <?= $this->Html->link(
            '&#10230;', 
            [
                'controller' => 'Blog',
                'action' => 'show',
                'slug' => $next->slug
            ],
            [
                'escape' => false, 
                'class' => 'prevnext_next', 
                'title' => $next->title, 
                'rel' => 'next'
            ]
        ); ?>
    <?php endif; ?>
</div>
