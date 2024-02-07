<?php
$this->Breadcrumbs->add('Inicio', '/');
$this->Breadcrumbs->add(ucfirst('playlists'), [
    'controller' => $this->request->getParam('controller'),
    'action' => 'index'
]);
$this->Breadcrumbs->add('Añadir playlist', [
    'controller' => $this->request->getParam('controller'),
    'action' => 'add'
]);
$header = [
    'title' => 'Añadir playlist',
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
        <div class="form-block custom_selector_smdev">
            <h3>Datos generales de la playlist</h3>
            <?= $this->Form->control(
                'name',
                [
                    'label' => 'Nombre de la playlist',
                    'type' => 'text',
                    'templateVars' => [
                        'max' =>  100
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



            <!-- <?= $this->Form->control(
                        'songs._ids',
                        [
                            'label' => 'Songs',
                            'options' => $songs,
                            'escape' => false
                        ]
                    ); ?> -->

            <?= $this->Form->control(
                'songs._ids',
                [
                    'label' => 'Songs',
                    'options' => $songs,
                    'escape' => false
                ]
            ); ?>




        </div><!-- .form-block -->

    </div><!-- .primary -->
    <?= $this->element("form/save-block"); ?>
    <?= $this->Form->end(); ?>
</div><!-- .content -->