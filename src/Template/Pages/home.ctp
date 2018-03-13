<?php
use Cake\Core\Configure;
$this->assign('title', 'Home');
$this->Html->meta('description', Configure::read('site_description'), ['block' => 'meta']);
$this->Html->meta('canonical', $this->Url->build('/', true), ['rel' => 'canonical', 'type' => null, 'title' => null, 'block' => 'meta']);
?>

<p>Homepage 'pages/home'</p>