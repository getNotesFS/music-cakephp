<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Error\Debugger;

$this->layout = false;



$cakeDescription = 'OWN CMS - Gestores de Contenido Web';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
    <script src="https://kit.fontawesome.com/66d7b97049.js" crossorigin="anonymous"></script>
</head>

<body class="home">

    <header class="row">
        <div class="header-image"><i class="fa-solid fa-headphones-simple fa-4x" style="color: #ffffff;"></i></div>
        <div class="header-title">
            <h1>Welcome to my OWN CMS <small><em style="color:white">by Sebastián M.</em></small></h1>

        </div>

    </header>

    <div class="row">
        <div class="search-container" style="padding:1em">
            <div class="search-form">
                <?= $this->Form->create(null, ['type' => 'get', 'url' => ['controller' => 'Pages', 'action' => 'display', 'home']]) ?>
                <?= $this->Form->control('keyword', ['label' => 'Search', 'placeholder' => "Search a song", 'value' => $this->request->getQuery('keyword')]) ?>
                <?= $this->Form->button(__('Search song')) ?>
                <?= $this->Form->end() ?>
            </div>

            <!-- Resultados de búsqueda solo si hay una búsqueda -->
            <?php if (!empty($searchResults)) : ?>
                <div class="search-results">
                    <h3 style="font-size: 1.4em;font-weight: bold;">Resultados de la búsqueda</h3>
                    <ul>
                        <?php foreach ($searchResults as $result) : ?>
                            <li class="bullet success">
                               
                                <a href="<?= h($result->link_spotify) ?>" target="_blank"><i class="fa-brands fa-spotify"></i>
                                
                                <b><?= h($result->name) ?></b>  [<?= h($result->album->name) ?>] | by <?= h($result->album->artist->name) ?>
                            
                            </a>
                        

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <hr>
            <?php endif; ?>
        </div>
    </div>



    <!-- Lista predeterminada de canciones -->
    <div class="row">
        <div class="columns large-6">

            <h3>Songs <small><?= $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Manage', ['controller' => 'Songs', 'action' => 'index'], ['escape' => false]) ?></small></h3>
            <ul>
                <?php foreach ($songs as $song) : ?>
                    <li>
                    <a href="<?= h($song->link_spotify) ?>" target="_blank"><i class="fa-brands fa-spotify"></i><b><?= h($song->name) ?></b> - <?= h($song->album->name) ?> | by <?= h($song->album->artist->name) ?></a>
                    
                </li>
                <?php endforeach; ?>
            </ul>

            <h3>Albums <small><?= $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Manage', ['controller' => 'Albums', 'action' => 'index'], ['escape' => false]) ?></small></h3>
            <ul>
                <?php foreach ($albums as $album) : ?>
                    <li><i class="fa-solid fa-angle-right"></i><b><?= h($album->name) ?></b> [<?= h($album->release_date->format('Y')) ?>] - by <?= h($album->artist->name) ?> </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="columns large-6">
            <h3>Artists <small><?= $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Manage', ['controller' => 'Artists', 'action' => 'index'], ['escape' => false]) ?></small></h3>
            <ul>
                <?php foreach ($artists as $artist) : ?>
                    <li><i class="fa-solid fa-angle-right"></i><b><?= h($artist->name) ?></b> - <?= h($artist->country) ?> </li>
                <?php endforeach; ?>
            </ul>
            <h3>Genders of Music <small><?= $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Manage', ['controller' => 'Genders', 'action' => 'index'], ['escape' => false]) ?></small></h3>
            <ul>
                <?php foreach ($genders as $gender) : ?>
                    <li><i class="fa-solid fa-angle-right"></i><b><?= h($gender->name) ?></b> </li>
                <?php endforeach; ?>
            </ul>


            <h3>Discographies <small><?= $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Manage', ['controller' => 'Discographies', 'action' => 'index'], ['escape' => false]) ?></small></h3>
            <ul>
                <?php foreach ($discographies as $discography) : ?>
                    <li><i class="fa-solid fa-angle-right"></i><b><?= h($discography->name) ?></b> </li>
                <?php endforeach; ?>
            </ul>







        </div>

        <div class="row">
            <div class="columns large-12">

                <!-- <h3>Current Playlists <small><a href="/playlists"><i class="fa-solid fa-pen-to-square"></i>Manage</a></small> </h3> -->
                <h3>Playlists <small><?= $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Manage', ['controller' => 'Playlists', 'action' => 'index'], ['escape' => false]) ?></small></h3>



                <ul>


                    <?php foreach ($playlists as $playlist) : ?>
                        <li style="background-color: #96a6a512;padding: 1em;border-radius: 5px;">
                            <h4 class="playlist-title"><i class="fa-solid fa-music"></i> <?= h($playlist->name) ?></h4>
                            <ul>
                                <?php foreach ($playlist->songs as $song) : ?>
                                    <li>
                                    <a href="<?= h($song->link_spotify) ?>" target="_blank"><i class="fa-brands fa-spotify"></i><b><?= h($song->name) ?></b> - <?= h($song->album->name) ?> | by <?= h($song->album->artist->name) ?></a>
                        
                                   
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                           
                        </li>
                        <hr>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>



</body>

</html>