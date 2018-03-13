<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('Iframe') ?></title>
    <?= $this->Html->css('dashboard.css') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="iframe">
    <main class="main clear">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
    <?= $this->Html->script('jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('dashboard.js') ?>
    <?= $this->fetch('script') ?>
    <?= $this->fetch('inline') ?>
</body>
</html>