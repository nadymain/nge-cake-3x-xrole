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
$site_title = Configure::read('site_title');
$site_logo = Configure::read('site_logo');
$site_tagline = Configure::read('site_tagline');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('title') . ' – ' . $site_title ?></title>
    <link rel="icon" type="image/png" href="<?= $this->Url->build('/', true) . 'img/favicon.png' ?>">
    <link rel="apple-touch-icon" href="<?= $this->Url->build('/', true) . 'img/touch-icon-iphone.png' ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->Url->build('/', true) . 'img/touch-icon-ipad.png' ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->Url->build('/', true) . 'img/touch-icon-iphone-retina.png' ?>">
    <link rel="apple-touch-icon" sizes="167x167" href="<?= $this->Url->build('/', true) . 'img/touch-icon-ipad-retina.png' ?>">
    <?= $this->Html->css('main'); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <?php if ($this->request->session()->read('Auth.User')) : ?>
        <?= $this->element('Main/topbar') ?>
    <?php endif ?>
    
    <div class="container">
        <?= $this->cell('MainMenu'); ?>
        
        <header id="header" class="header">
            <?= $this->Flash->render() ?>

            <?php if ($site_logo) : ?> 
                <?= $this->Html->image($site_logo, [
                    'url' => '/',
                    'alt' => $site_title,
                    'class' => 'header_logo'
                ]) ?>
            <?php endif ?>

            <h1 class="header_title">
                <?= $this->Html->link($site_title, '/'); ?>
            </h1>
            
            <?php if ($site_tagline) : ?> 
                <p class="header_tagline"><?= h($site_tagline); ?></p>
            <?php endif ?>
        </header>

        <main class="main">
            <?= $this->fetch('content') ?>
        </main>
        
		<footer id="footer" class="footer">
			<p><?php echo __('&copy; ' . $this->Html->link($site_title, '/') . date(' Y')); ?></p>
		</footer>

    </div> <!-- container -->

    <?= $this->Html->script('jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('main.js') ?>
    <?= $this->fetch('script') ?>
    <?= $this->fetch('inline') ?>
</body>
</html>
