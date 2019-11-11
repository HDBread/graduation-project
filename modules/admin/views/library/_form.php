<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Library */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="library-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Название статьи') ?>

    <?= $form->field($model, 'excerpt')->textInput(['maxlength' => true])->label('Краткое описание статьи') ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6])->label('Полное описание статьи') ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true])->hint('Перечислите ключевые слова через запятую (word, word)')->label('Ключевые слова для статьи') ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
