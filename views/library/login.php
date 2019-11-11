<h1 align='center'> Авторизация </h1>

<?php 
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($login_model, 'email')->textInput() ?>
<?= $form->field($login_model, 'password')->passwordInput() ?>

<div style="margin: 0 auto">
    <button class="btn btn-danger" type="button" onclick='location.href="/"' > Отмена </button>
    <button class="btn btn-success" type="submit"> Авторизироваться </button>    
</div>

<?php $form = ActiveForm::end(); ?>
