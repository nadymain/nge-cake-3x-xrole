<a href="#" class="navmenu_btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
        <path d="M4 27h28v-3H4v3zm0-8h28v-3H4v3zM4 8v3h28V8H4z"/>
    </svg>
</a>

<nav class="navmenu clear">
    <h3 class="hidden_element">Blog Menu</h3>

    <ul>
    <?php foreach ($mainmenu as $menu) : ?>
        <?php if (!empty($menu->children)) : ?>
            <li class="dropdown">
            <?= $this->Html->link($menu->name, $menu->link) ?>
                <ul>
                <?php foreach ($menu->children as $child) : ?>
                    <li>
                        <?= $this->Html->link($child->name, $child->link) ?>
                    </li>
                <?php endforeach ?>
                </ul>
            </li>
        <?php else : ?>
            <li class="<?= $this->MyMenu->mainactive($menu->link) ?>">
                <?= $this->Html->link($menu->name, $menu->link) ?>
            </li>
        <?php endif ?>
    <?php endforeach ?>
    </ul>

    <?php  
        echo $this->Form->create(null, [
            'url' => $this->Url->build('/blog', true), 
            'valueSources' => 'query'
        ]);
        echo $this->Form->input('q', [
            'label' => false, 
            'templates' => ['inputContainer' => '{{content}}'], 
            'placeholder' => 'Search...'
        ]);
        echo $this->Form->end();
    ?>
</nav>
