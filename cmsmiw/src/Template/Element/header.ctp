<header>
<?php
use Cake\Core\Configure;
use Cake\I18n\I18n;

if ((isset($breadcrumbs) && $breadcrumbs === true) || isset($languages)) {
?>
    <div class="top-header">
    <?= $this->Breadcrumbs->render(
        ['class' => 'breadcrumbs'],
        ['separator' => ' &raquo; ']
    ); ?>
    <?php
    if(isset($languages)) {
        ?>
        <div class="languages">
        <?php
        if(count(Configure::read('I18N.locales')) > 1){
            foreach (Configure::read('I18N.locales') as $code => $name) {
                $current = "";
                if($code == I18n::getLocale()){
                    $current = "current";
                }
                $link = $languages;
                array_push($link, $code);
                echo $this->Html->link($name, $link, ['class' => 'link ' . $current]);
            }
        }
        ?>
        </div><!-- .languages -->
        <?php
    }
    ?>
    </div><!-- .top-header -->
    <?php
}
?>

    <div class="mid-header">
        <h2><?= $title; ?></h2>
<?php
if (isset($header)) {
    if (isset($header['actions']) && !empty($header['actions'])) {
        ?>
        <div class="actions">
        <?php
        foreach ($header['actions'] as $action_name => $config) {
            if (!isset($config['options'])) {
                $config['options'] = [];
            }
            $config['options']['class'] = 'button';
            echo $this->Html->link(
                $action_name,
                $config['url'],
                $config['options']
            );
        }
        ?>
        </div><!-- .actions -->
        <?php
    }
    if (isset($header['buttons']) && !empty($header['buttons'])) {
        ?>
        <div class="actions">
        <?php
        foreach ($header['buttons'] as $action_name => $config) {
            $class = isset($config['class'])? $config['class']: '';
            ?>
            <span class="button <?= $class; ?>" data-action="<?= $config['action'];?>"><?= $action_name; ?></span>
            <?php
        }
        ?>
        </div><!-- .actions -->
        <?php
    }
    if (isset($header['dropdown']) && !empty($header['dropdown'])) {
        $layout = isset($header['dropdown']['layout'])? $header['dropdown']['layout']: 'four';
        ?>
        <div class="dropdown">
            <span class="button"><?= $header['dropdown']['name']; ?> <span class="down"><i class="fas fa-angle-right fa-2x"></i></span></span>
            <div class="options <?= $layout; ?>">
            <?php
            foreach ($header['dropdown']['actions'] as $action_name => $config) {
                ?>
                <a class="action" href="<?= $this->Url->build($config['url']); ?>">
                    <?php
                    if (isset($config['image'])) {
                        echo $this->Html->image(
                            $config['image']
                        );
                        unset($config['image']);
                    }
                    ?>
                    <span><?= $action_name; ?></span>
                </a>
                <?php
            }
            ?>
            </div><!-- .options -->
        </div><!-- .dropdown -->
        <?php
    }
    if (isset($header['search_form'])) {
        $search_form = $header['search_form'];
        ?>
        <div class="search">
            <?= $this->Form->create(null,
                [
                    'url' => isset($header['search_form']['url'])? $header['search_form']['url']: ['action' => 'index'],
                    'class' => 'search-form'
                ]
            ); ?>
                <?= $this->Form->control(
                    'keyword',
                    [
                        'label' => false,
                        'type' => 'text',
                        'value' => $keyword
                    ]
                ); ?>
                <?= $this->Form->button(
                    '<i class="fa fa-search" aria-hidden="true"></i>',
                    [
                        'class' => 'button',
                        'escape' => false
                    ]
                );?>
            <?= $this->Form->end();?>
        </div><!-- .search -->
        <?php
    }
    if (isset($header['ajax_search'])) {
        $action = $header['ajax_search']['action'];
        ?>
        <div class="search">
            <div class="search-form">
                <div class="input text">
                    <input type="text" name="keyword" />
                </div><!-- .input -->
                <span class="button" data-action="<?= $action; ?>"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div><!-- .search-form -->
        </div><!-- .search -->
        <?php
    }

    if (isset($header['close'])) {
        ?>
        <div class="close-button">
            <span class="button close">Cerrar <i class="fa fa-times"></i></span>
        </div><!-- .close-button -->
        <?php
    }
}
?>
    </div><!-- .mid-header -->

<?php
if (isset($tabs) && !empty($tabs)) {
    ?>
    <div class="header-tabs">
        <div class="content-tabs">
        <?php
        foreach ($tabs as $tab_name => $config) {
            echo $this->Html->link(
                $tab_name,
                $config['url'],
                [
                    'class' => 'tab ' . $config['current']
                ]
            );
        }
        ?>
        </div><!-- .content-tabs -->
    </div><!-- .header-tabs -->
    <?php
}

if (isset($keyword) && $keyword != "") {
    ?>
    <p class="search-results">Resultados de la búsqueda: <strong><?= $keyword; ?></strong></p>
    <?php
}
?>
</header>
