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
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
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
    <?= $this->Html->css('miw.css') ?>

    <?php
    // JQUERY         
                      
    $this->Html->css('vendors/jquery-ui-1.12.1/jquery-ui.min', ['block' => 'vendors']);
    $this->Html->script('vendors/jquery/jquery-3.3.1.min', ['block' => 'vendors']);
    $this->Html->script('vendors/jquery/jquery-ui-1.12.1/jquery-ui.min', ['block' => 'vendors']);

    // SELECT 2
    $this->Html->css('vendors/select2/select2.min', ['block' => 'vendors']);
    $this->Html->script('vendors/select2/select2.full.min', ['block' => 'vendors']);
    $this->Html->script('vendors/select2/select2_locale_es', ['block' => 'vendors']);

    // TINYMCE
    $this->Html->script("https://cdn.tiny.cloud/1/klo5ksu6b33ps44y54astgnm0zrhu3osdzolizsdufbq962l/tinymce/6/tinymce.min.js", ['block' => "vendors"]);
    //$this->Html->script('vendors/tinymce/es', ['block' => 'vendors']);

        // FUNCTIONS
        $this->Html->script('functions', ['block' => 'scripts']);

    echo $this->fetch('css');
    echo $this->fetch('vendors');
    echo $this->fetch('scripts');

    ?>
</head>
<body>
    <!--<nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>-->
    <?= $this->Flash->render() ?>
    <div class="container clearfix full" id="main-content">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
