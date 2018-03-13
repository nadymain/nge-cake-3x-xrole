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
    <title><?= __('Oops!') ?></title>
    <link rel="icon" type="image/png" href="<?= $this->Url->build('/', true) . 'img/favicon.png' ?>">
    <link rel="apple-touch-icon" href="<?= $this->Url->build('/', true) . 'img/touch-icon-iphone.png' ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->Url->build('/', true) . 'img/touch-icon-ipad.png' ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->Url->build('/', true) . 'img/touch-icon-iphone-retina.png' ?>">
    <link rel="apple-touch-icon" sizes="167x167" href="<?= $this->Url->build('/', true) . 'img/touch-icon-ipad-retina.png' ?>">
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->meta('robots', 'noindex') ?>
</head>
<body>
    <?php if ($this->request->session()->read('Auth.User')) : ?>
        <?= $this->element('Main/topbar') ?>
    <?php endif ?>

    <div class="container">

        <?= $this->cell('MainMenu'); ?>

        <header id="header" class="header">
            <?= $this->Flash->render() ?>
            <a class="oops_back", title="Back" href="javascript:history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </a>
            <h1 class="header_title"><?= __('Oops!') ?></h1>
            <p  class="header_tagline"><?= __('It looks like something went wrong.') ?></p>
        </header>

        <main class="main">
            <?= $this->fetch('content') ?>
        </main>

		<footer id="footer" class="footer">
			<p><?php echo __('&copy; Oops!' . date(' Y')); ?></p>
        </footer>
        
    </div>

    <?= $this->Html->script('jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('main.js') ?>
    <?= $this->fetch('script') ?>
</body>
</html>
