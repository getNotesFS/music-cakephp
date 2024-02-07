<?php
$this->Breadcrumbs->add('Inicio', '/');
$this->Breadcrumbs->add(ucfirst('albums'), [
    'controller' => $this->request->getParam('controller'),
    'action' => 'index'
]);
$this->Breadcrumbs->add('Editar album' . ' ' . $entity->title, [
    'controller' => $this->request->getParam('controller'),
    'action' => 'edit',
    $entity->id
]);
$header = [
    'title' => 'Editar album',
    'breadcrumbs' => true
];
?>

<?= $this->element("header", $header); ?>

<div class="content">
    <?= $this->Form->create(
        $entity,
        [
            'class' => 'admin-form',
            'type' => 'file'
        ]
    ); ?>
    <div class="primary">
        <div class="form-block">
            <h3>Datos generales del album</h3>
            <?= $this->Form->control(
                'name',
                [
                    'label' => 'Nombre del album',
                    'type' => 'text',
                    'templateVars' => [
                        'max' =>  100
                    ]
                ]
            ); ?> 

            <?= $this->Form->control('release_date', [
                'label' => 'Fecha de lanzamiento',
                'type' => 'text', 
                'templates' => [
                    'input' => '<input type="date" value="'.$entity->release_date->format('Y-m-d').'" name="{{name}}"{{attrs}}/>',
                ]
            ]); ?>



            <?= $this->Form->control(
                'artist_id',
                [
                    'label' => 'Artista',
                    'options' => $artists,
                    'escape' => false
                ]
            ); ?>

        </div><!-- .form-block -->
    </div><!-- .primary -->
    <?= $this->element("form/save-block"); ?>
    <?= $this->Form->end() ?>
</div><!-- .content -->