<?php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\I18n\I18n;
use DateTime;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends AppController
{
    public $entity_name = 'album';
    public $entity_name_plural = 'albums';

    public $table_buttons = [
        'Editar' => [
            'url' => [
                'controller' => 'Albums',
                'action' => 'edit',
                'plugin' => false
            ],
            'options' => [
                'class' => 'button'
            ]
        ],
        'Borrar' => [
            'url' => [
                'controller' => 'Albums',
                'action' => 'delete',
                'plugin' => false
            ],
            'options' => [
                'confirm' => '¿Está seguro de que desea eliminar el album?',
                'class' => 'button'
            ]
        ]
    ];

    public $header_actions = [
        'Añadir album' => [
            'url' => [
                'controller' => 'Albums',
                'plugin' => false,
                'action' => 'add'
            ]
        ],
        'Adm. Géneros' => [
            'url' => [
                'controller' => 'Genders',
                'plugin' => false,
                'action' => 'index'
            ]
        ],
        'Adm. Canciones' => [
            'url' => [
                'controller' => 'Songs',
                'plugin' => false,
                'action' => 'index'
            ]
        ],
        'Adm. Discografías' => [
            'url' => [
                'controller' => 'Discographies',
                'plugin' => false,
                'action' => 'index'
            ]
        ],
        'Adm. Artistas' => [
            'url' => [
                'controller' => 'Artists',
                'plugin' => false,
                'action' => 'index'
            ]
        ],
        'Adm. Playlists' => [
            'url' => [
                'controller' => 'Playlists',
                'plugin' => false,
                'action' => 'index'
            ]
        ]
    ];

    // Default pagination settings
    public $paginate = [
        'limit' => 20,
        'order' => [
            'Albums.published_date' => 'DESC',
            'Albums.published_time' => 'DESC'
        ]
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($keyword = null)
    {
        if ($this->request->is('post')) {
            //recover the keyword
            $keyword = $this->request->getData('keyword');
            //re-send to the same controller with the keyword
            return $this->redirect(['action' => 'index', $keyword]);
        }

        // Paginator
        $settings = $this->paginate;
        // If performing search, there is a keyword
        if ($keyword != null) {
            // Change pagination conditions for searching
            $settings['conditions'] = [
                'OR' => [
                    $this->getName() . '.title LIKE' => '%' . $keyword . '%',
                    $this->getName() . '.description LIKE' => '%' . $keyword . '%'
                ]
            ];
        }

        //prepare the pagination
        $this->paginate = $settings;
        $entities = $this->paginate($this->modelClass);

        $this->set('entities', $entities);
        $this->set('keyword', $keyword);
        $this->set('header_actions', $this->header_actions);
        $this->set('table_buttons', $this->table_buttons);
        $this->set('_serialize', 'entities');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $entity = $this->{$this->getName()}->newEntity();
        if ($this->request->is('post')) {
            $entity = $this->{$this->getName()}->patchEntity($entity, $this->request->getData());

            if ($this->{$this->getName()}->save($entity)) {
                return $this->redirect(['action' => 'index']);
            }
        }

        $artists = $this->{$this->getName()}->Artists->find('list');

        // if ($entity->getErrors()) {
        //     $this->Flash->error(__('No se ha podido guardar el álbum. Por favor, intente nuevamente.'));
        // }

        $this->set(compact('entity', 'artists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $locale = null)
    {

        $entity = $this->{$this->getName()}->get($id);


        if ($this->request->is(['patch', 'post', 'put'])) {

            $entity = $this->{$this->getName()}->patchEntity($entity, $this->request->getData());

            echo $entity->get('release_date');

            if ($this->{$this->getName()}->save($entity)) {
                return $this->redirect(
                    [
                        'action' => 'edit',
                        $entity->id
                    ]
                );
            }
        }

        $artists = $this->{$this->getName()}->Artists->find('list');



        if ($entity->getErrors()) {
            $this->Flash->error(__('No se ha podido guardar el álbum. Por favor, intente nuevamente.'));
        }

        $this->set(compact('entity', 'artists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $entity = $this->{$this->getName()}->get($id);
        $this->{$this->getName()}->delete($entity);

        return $this->redirect(['action' => 'index']);
    }
}
