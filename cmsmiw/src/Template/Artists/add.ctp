<?php
$this->Breadcrumbs->add('Inicio', '/');
$this->Breadcrumbs->add(ucfirst('artists'), [
    'controller' => $this->request->getParam('controller'),
    'action' => 'index'
]);
$this->Breadcrumbs->add('Añadir artist', [
    'controller' => $this->request->getParam('controller'),
    'action' => 'add'
]);
$header = [
    'title' => 'Añadir artist',
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
            <h3>Datos generales del artista</h3>
            <?= $this->Form->control(
                'name',
                [
                    'label' => 'Nombre del artista',
                    'type' => 'text',
                    'required' => true,
                    'templateVars' => [
                        'max' =>  100
                    ]
                ]
            ); ?>

            <?= $this->Form->control(
                'biography',
                [
                    'label' => 'Biografía',
                    'rows' => 5,
                    'templateVars' => [
                        'max' =>  200
                    ]
                ]
            ); ?>
            <?= $this->Form->control(
                'country',
                [
                    'label' => 'País',
                    'type' => 'text',
                    'required' => true,
                    'templateVars' => [
                        'max' =>  100
                    ]
                ]
            ); ?>

            <?= $this->Form->control(
                'age',
                [
                    'label' => 'Edad',
                    'type' => 'number',
                    'required' => false,
                    'templateVars' => [
                        'max' =>  3
                    ]
                ]
            ); ?>

            <?= $this->Form->control(
                'discography_id',
                [
                    'label' => 'Discografía',
                    'options' => $discographies,
                    'escape' => false
                ]
            ); ?>

        </div><!-- .form-block -->

    </div><!-- .primary -->
    <?= $this->element("form/save-block"); ?>
    <?= $this->Form->end(); ?>
</div><!-- .content -->