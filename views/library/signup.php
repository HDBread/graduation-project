<h1 align='center'> Регистрация </h1>

<?php
use yii\widgets\ActiveForm;
?>

<?php 
$form = ActiveForm::begin(['class' => 'form-horizontal']);
?>
<div aling="center" class="form-group">

<?= $form->field($model, 'email')->textInput(['autofocus' => true])?>
<?= $form->field($model, 'username')->textInput(array('class' => ['form-control form-center']))?>
<?=$form->field($model, 'password')->passwordInput()?>
<?=$form->field($model, 'verifyPassword')->passwordInput()?>
</div>

<div>    
    <button class="btn btn-danger" type="button" onclick='location.href="/"' > Отмена </button>
    <button type="submit" class="btn btn-primary">Зарегистрироваться</button> 
</div>


<?php
ActiveForm::end();
?>