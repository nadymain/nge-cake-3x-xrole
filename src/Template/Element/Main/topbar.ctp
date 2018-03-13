<nav class="topbar">
    <h3 class="hidden_element">Menu Top</h3>
    <?= $this->Html->link('Dashboard', 
        ['prefix' => 'dashboard', 'controller' => 'articles', 'action' => 'index'], 
        ['class' => 'topbar_dashboard hidden_mobile']
    ); ?>
    <div class="topbar_add dropdown">
        <a href="#" title="Toggle Add">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
            </svg>
        </a>
        <ul>
            <li>
                <?= $this->Html->link('Add Article', [
                    'prefix' => 'dashboard',
                    'controller' => 'Articles',
                    'action' => 'add'
                ]) ?>
            </li>
            <li>
                <?= $this->Html->link('Add Info', [
                    'prefix' => 'dashboard',
                    'controller' => 'Infos',
                    'action' => 'add'
                ]) ?>
            </li>
            <li>
                <?= $this->Html->link('Add Image', [
                    'prefix' => 'dashboard',
                    'controller' => 'Images',
                    'action' => 'add'
                ]) ?>
            </li>
            <li>
                <?= $this->Html->link('Add Menu', [
                    'controller' => 'Menus',
                    'action' => 'add'
                ]) ?>
            </li>
        </ul>
    </div>
    <div class="topbar_user dropdown">
        <a href="#" title="Toggle User">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M9 8c1.66 0 2.99-1.34 2.99-3S10.66 2 9 2C7.34 2 6 3.34 6 5s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V16h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
            Hi. <?= $this->request->session()->read('Auth.User.name') ?>
        </a>
        <ul>
            <li>
                <?= $this->Html->link('Edit Profile', [
                    'prefix' => 'dashboard',
                    'controller' => 'Users', 
                    'action' => 'edit', $this->request->session()->read('Auth.User.id')
                ]) ?>
            </li>
            <li>
                <?= $this->Html->link('Logout', [
                    'controller' => 'Logged',
                    'action' => 'out'
                ]) ?>
            </li>
        </ul>
    </div>
</nav>
