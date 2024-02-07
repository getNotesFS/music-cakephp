<?php
$this->Breadcrumbs->add('Inicio', '/');

$this->Breadcrumbs->add(ucfirst('genders'), [
    'controller' => $this->request->getParam('controller'),
    'action' => 'index'
]);
$this->Breadcrumbs->add('Editar género' . ' ' . $entity->name, [
    'controller' => $this->request->getParam('controller'),
    'action' => 'edit',
    $entity->id
]);
$header = [
    'title' => 'Editar género' . ' ' . $entity->name,
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
                    'label' => 'Nombre del género',
                    'type' => 'text'
                ]
            ); ?>
             


        </div><!-- .form-block -->
    </div><!-- .primary -->
    <?= $this->element("form/save-block"); ?>
    <?= $this->Form->end() ?>
</div><!-- .content -->