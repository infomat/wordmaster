<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Word Master';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('flatly.bootstrap.min.css') ?>
    <?= $this->Html->css('jquery-ui.css') ?> 
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('wordmaster.css') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') ?> 
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <h1 id="title">
            <h1>Word Master<small>Improve your word power</small><a href="#"></h1>
        </h1>
    </header>
    
    <nav class="navbar navbar-default">
        <?= $this->element('navbar'); ?>
    </nav>    
    
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
        <?= $this->element('footer'); ?>
    </footer>
</body>
    <?= $this->Html->script('http://code.jquery.com/ui/1.11.4/jquery-ui.js') ?>
    <?= $this->Html->script('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') ?>
</html>
