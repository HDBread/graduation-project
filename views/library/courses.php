<?php

use yii\widgets\ActiveForm;
?>

<h1 align='center'> Список курсов </h1>

<?php 

if($courses == NULL)
{ ?>
<h2>Ни один курс не был создан</h2>
<?php }
else
{ 
    foreach ($courses as $course) { ?>
        
        <div class="form-group">
            <li>
                <strong><a href=" <?= \yii\helpers\Url::to(['library/course', 'id' => $course->id]) ?>"> <?= $course->courseName ?></a>
                 <!--Html::a($book->title, ['library/publications', 'id' => $book->id], ['class' => 'profile-link'])-->
                </strong>
            </li>
        </div>

    <?php }
}

?>

<div>
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalCourse"> Создать курс </button>
</div>

<!-- Модальное окно для создания курса -->
<div class="modal fade" id="modalCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 align="center" class="modal-title" id="exampleModalLabel">Создание курса</h3>
      </div>
      <div class="modal-body">
        <div>
            <?= $form->field($course_model, 'name')->label('Название курса')->textInput(); ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Создать</button>
      </div>
    </div>
  </div>
  <?php  ActiveForm::end();?>
</div>
