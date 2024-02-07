<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     * 
     * 
     */


    public function display(...$path)
    {





        if (!$path) {
            return $this->redirect('/');
        }


        // Carga los modelos necesarios
        $this->loadModel('Songs');
        $this->loadModel('Albums');
        $this->loadModel('Discographies');
        $this->loadModel('Playlists');
        $this->loadModel('Genders');
        $this->loadModel('Artists');

        // Inicializa la variables
        $songs = [];
        $albums = [];
        $discographies = [];
        $playlists = [];
        $genders = [];
        $artists = [];

        // Variable para los resultados de búsqueda
        $searchResults = [];
        $keyword = $this->request->getQuery('keyword');
        if (!empty($keyword)) {
            
            $searchResults = $this->Songs->find()
                ->contain(['Albums' => ['Artists']])
                ->where([
                    'OR' => [
                        'Songs.name LIKE' => '%' . $keyword . '%',
                        'Albums.name LIKE' => '%' . $keyword . '%', 
                        'Artists.name LIKE' => '%' . $keyword . '%' 
                    ]
                ])
                ->all();
        }

        // Lista predeterminada de canciones, siempre se carga
        $songs = $this->Songs->find()
            ->contain(['Albums' => ['Artists']])
            ->all();

        // Lista predeterminada de álbumes, discografías, listas de reproducción y géneros
        $albums = $this->Albums->find()
            ->contain(['Artists'])
            ->limit(10)
            ->all();
        $discographies = $this->Discographies->find()
            ->limit(10)
            ->all();

        $playlists = $this->Playlists->find()
            ->contain(['Songs' => ['Albums' => ['Artists']]])
            ->all();

        $genders = $this->Genders->find()
            ->limit(10)
            ->all();

        $artists = $this->Artists->find()
            ->limit(10)
            ->all();


        // Pasar los resultados a la vista
        $this->set(compact('songs', 'searchResults', 'albums', 'discographies', 'playlists', 'genders', 'artists'));


        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
