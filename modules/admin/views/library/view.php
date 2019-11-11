<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Library */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="library-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute' => 'id', 'label' => '№ статьи'],
            ['attribute' => 'title', 'label' => 'Название статьи'],
            ['attribute' => 'excerpt', 'label' => 'Краткое описание статьи'],
            ['attribute' => 'text', 'label' => 'Полное описание статьи'],            
            ['attribute' => 'keywords', 'label' => 'Ключевые слова для статьи'],
            ['attribute' => 'description', 'label' => 'Дискриптион'],

        ],
    ]) ?>

</div>
