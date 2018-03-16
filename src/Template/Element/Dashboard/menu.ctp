<nav class="menu">
    <h3 class="hidden_element">Menu Aside</h3>
    <ul class="menu-ul">
        <li class="<?= $this->MyMenu->dashboardActive('Articles') ?>">
            <?= $this->Html->link('Articles', [
                'controller' => 'Articles',
                'action' => 'index'
            ]) ?>
        </li>
        <li class="<?= $this->MyMenu->dashboardActive('Tags') ?>">
            <?= $this->Html->link('Tags', [
                'controller' => 'Tags',
                'action' => 'index'
            ]) ?>
        </li>
        <li class="<?= $this->MyMenu->dashboardActive('Infos') ?>">
            <?= $this->Html->link('Infos', [
                'controller' => 'Infos',
                'action' => 'index'
            ]) ?>
        </li>
        <li class="<?= $this->MyMenu->dashboardActive('Images') ?>">
            <?= $this->Html->link('Images', [
                'controller' => 'Images',
                'action' => 'index'
            ]) ?>
        </li>
        <li class="<?= $this->MyMenu->dashboardActive('Menus') ?>">
            <?= $this->Html->link('Menus', [
                'controller' => 'Menus',
                'action' => 'index'
            ]) ?>
        </li>
        <li class="<?= $this->MyMenu->dashboardActive('Settings') ?>">
            <?= $this->Html->link('Settings', [
                'controller' => 'Settings',
                'action' => 'index'
            ]) ?>
        </li>
        <li class="<?= $this->MyMenu->dashboardActive('Users') ?>">
            <?= $this->Html->link('Users', [
                'controller' => 'Users',
                'action' => 'index'
            ]) ?>
        </li>
    </ul>
</nav>
