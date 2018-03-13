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

use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= __('Dashboard - ') . $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('dashboard.css') ?>
    <?= $this->Html->meta('robots', 'noindex, nofollow') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <?= $this->element('Dashboard/topbar') ?>
    <?= $this->element('Dashboard/menu') ?>

    <main class="main clear">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>

    <footer class="footer">
        <p><?= Configure::read('site_title'); ?> - CakePHP <?= Configure::version(); ?></p>
    </footer>

    <?= $this->Html->script('jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('dashboard.js') ?>
    <?= $this->fetch('script') ?>
    <?= $this->fetch('inline') ?>
</body>
</html>
