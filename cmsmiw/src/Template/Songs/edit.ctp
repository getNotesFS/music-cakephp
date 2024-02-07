<?php
$this->Breadcrumbs->add('Inicio', '/');
$this->Breadcrumbs->add(ucfirst('songs'), [
    'controller' => $this->request->getParam('controller'),
    'action' => 'index'
]);
$this->Breadcrumbs->add('Editar canción' . ' ' . $entity->title, [
    'controller' => $this->request->getParam('controller'),
    'action' => 'edit',
    $entity->id
]);
$header = [
    'title' => 'Editar canción',
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
            <h3>Datos generales de la canción</h3>
            <?= $this->Form->control(
                'name',
                [
                    'label' => 'Nombre de la canción',
                    'type' => 'text',
                    'templateVars' => [
                        'max' =>  100
                    ]
                ]
            ); ?>

            <?= $this->Form->control(
                'link_spotify',
                [
                    'label' => 'Link de Spotify',
                    'type' => 'url',
                    'templateVars' => [
                        'max' =>  250
                    ]
                ]
            ); ?>


            <?= $this->Form->control(
                'gender_id',
                [
                    'label' => 'Género',
                    'options' => $genders,
                    'escape' => false
                ]
            ); ?>

            <?= $this->Form->control(
                'album_id',
                [
                    'label' => 'Álbum',
                    'options' => $albums,
                    'escape' => false
                ]
            ); ?>

        </div><!-- .form-block -->
    </div><!-- .primary -->
    <?= $this->element("form/save-block"); ?>
    <?= $this->Form->end() ?>
</div><!-- .content -->