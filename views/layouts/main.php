<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Научно-образовательный портал',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/']],
            ['label' => 'Зарегистрироваться', 'url' => ['/library/signup']],
            Yii::$app->user->isGuest ? 
                 (
                    ['label' => 'Войти', 'url' => ['/library/login']]
                )   : ( ['label' => Yii::$app->user->identity->username, 
                    'options' => ['class' => 'dropdown'],
                    'items' => [
                        ['label' => 'Панель администратора', 'url' => ['/admin'],
                            'visible' => Yii::$app->user->identity->role == 'admin'],
                        ['label' => 'Мои курсы', 'url' => ['/library/courses']],
                        ['label' => 'Личый кабинет', 'url' => ['/library/cabinet']],
                        ['label' => 'Выход', 'url' => ['/library/logout']]
                       ]
                    ]
            )
            
        ],
      
    ]);
    NavBar::end();
    ?>
    
    <div class="container">
        
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    
    
    
</div>

    
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Москалев Р.А. </p>

        <p class="pull-right"> ТУСУР <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
