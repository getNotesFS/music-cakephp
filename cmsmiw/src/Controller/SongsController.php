<?php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\I18n\I18n;

/**
 * Songs Controller
 *
 * @property \App\Model\Table\SongsTable $Songs
 */
class SongsController extends AppController
{
    public $entity_name = 'song';
    public $entity_name_plural = 'songs';

    public $table_buttons = [
        'Editar' => [
            'url' => [
                'controller' => 'Songs',
                'action' => 'edit',
                'plugin' => false
            ],
            'options' => [
                'class' => 'button'
            ]
        ],
        'Borrar' => [
            'url' => [
                'controller' => 'Songs',
                'action' => 'delete',
                'plugin' => false
            ],
            'options' => [
                'confirm' => '¿Está seguro de que desea eliminar la canción?',
                'class' => 'button'
            ]
        ]
    ];

    public $header_actions = [
        'Añadir canción' => [
            'url' => [
                'controller' => 'Songs',
                'plugin' => false,
                'action' => 'add'
            ]
        ],
        'Adm. Discografías' => [
            'url' => [
                'controller' => 'Discographies',
                'plugin' => false,
                'action' => 'index'
            ]
        ],
        'Adm. Albums' => [
            'url' => [
                'controller' => 'Albums',
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
        'Adm. Géneros' => [
            'url' => [
                'controller' => 'Genders',
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
            'Songs.published_date' => 'DESC',
            'Songs.published_time' => 'DESC'
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
       // $settings = $this->paginate;
       $settings = $this->paginate + [
        'contain' => ['Albums' => ['Artists']] // Incluye los datos de Albums y Artists
    ];

        // If performing search, there is a keyword
        if ($keyword != null) {
            // Change pagination conditions for searching
            $settings['conditions'] = [
                'OR' => [
                    'Songs.name LIKE' => '%' . $keyword . '%',  
                ]
            ];
        }
 

        //prepare the pagination
        $this->paginate = $settings;
        
        $entities = $this->paginate($this->Songs);
        //$entities = $this->paginate($this->modelClass);


        // Pasar los datos a la vista
       

       // $this->set('entities', $entities);
        //$this->set('keyword', $keyword);
        $this->set('header_actions', $this->header_actions);
        $this->set('table_buttons', $this->table_buttons);
        //$this->set('_serialize', 'entities');
        $this->set(compact('entities', 'keyword'));
        $this->set('_serialize', ['entities']);
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
        $genders = $this->{$this->getName()}->Genders->find('list');
        $albums = $this->{$this->getName()}->Albums->find('list');

        if ($entity->getErrors()) {
            $this->Flash->error(__('No se ha podido guardar el álbum. Por favor, intente nuevamente.'));
        }

        $this->set(compact('entity', 'genders', 'albums'));
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

            if ($this->{$this->getName()}->save($entity)) {
                return $this->redirect(
                    [
                        'action' => 'edit',
                        $entity->id
                    ]
                );
            }
        }

        $genders = $this->{$this->getName()}->Genders->find('list');
        $albums = $this->{$this->getName()}->Albums->find('list');

        if ($entity->getErrors()) {
            $this->Flash->error(__('No se ha podido guardar el álbum. Por favor, intente nuevamente.'));
        }

        $this->set(compact('entity', 'genders', 'albums')); 
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
