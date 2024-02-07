<?php
$this->Breadcrumbs->add('Inicio', '/');

$this->Breadcrumbs->add(ucfirst('discographies'), [
    'controller' => $this->request->getParam('controller'),
    'action' => 'index'
]);
$this->Breadcrumbs->add('Añadir discography', [
    'controller' => $this->request->getParam('controller'),
    'action' => 'add'
]);
$header = [
    'title' => 'Añadir discography',
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
    <div class="primary full">
        <div class="form-block">
            <h3>Datos generales del discography</h3>
            <?= $this->Form->control(
                'name',
                [
                    'label' => 'Nombre del discography',
                    'type' => 'text'
                ]
            ); ?>
            <?= $this->Form->control(
                'country',
                [
                    'label' => 'País',
                    'type' => 'text'
                ]
            ); ?>

            <?= $this->Form->control('launch_date', [
                'label' => 'Fecha de lanzamiento',
                'type' => 'text',
                'templates' => [
                    'input' => '<input type="date" name="{{name}}"{{attrs}}/>',
                ]
            ]); ?>


        </div><!-- .form-block -->
    </div><!-- .primary -->
    <?= $this->element("form/save-block"); ?>
    <?= $this->Form->end(); ?>
</div><!-- .content -->