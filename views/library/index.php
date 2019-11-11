<?php
// загрузка объекта ActiveForm, для работы с формами
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\sortable\Sortable;
use app\models\CourseList;
use yii\helpers\ArrayHelper;

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
    function fun(idCourse)
    {
        document.getElementById('courseIdHide').value = idCourse;
    }
    
    function getId(idPublication)
    {
        document.getElementById('idHide').value = idPublication;
    }
</script>

<!-- Стилистика для поля поиска --> 
<style>
    * {box-sizing: border-box;}
        .form-group_search form {
          position: relative;
          width: 300px;
          margin: 0 auto;
        }
        .form-group_search input {
          width: 100%;
          height: 42px;
          padding-left: 10px;
          border: 2px solid #7BA7AB;
          border-radius: 5px;
          outline: none;
          background: F9F0DA;
        }
        .form-group_search button {
          position: absolute; 
          top: 0;
          right: 0px;
          width: 42px;
          height: 42px;
          border: none;
          background: #7BA7AB;
          border-radius: 0 5px 5px 0;
          cursor: pointer;
        }
        .form-group_search button:before {
          content: "\f002";
          font-family: FontAwesome;
          font-size: 16px;
          color: #F9F0DA;
    }
</style>


<!-- Если поле поиска что-то содержит, то выводим содержание поля поиска -->
<?php if (!($search == '' || $search == NULL))
{ ?>
<h3> Результат поиска: <?= $search?> </h3> 
<?php } ?>

<!-- Форма поиска -->
<div class="form-group_search" align="center">
    <form method="get" action="<?= \yii\helpers\Url::to(['/library/search']) ?>">
        <div>
            <input type="search" name='name_search' id="inputName" placeholder="Поиск...">
            <button type="submit"></button>
        </div>
    </form>
</div>
<hr />

<div>
<?php if(!empty($books)): ?>
    
<?php $content = array();?>
    
    <!-- Перебор всех найденых пубикаций -->
<?php foreach($books as $book): ?>

    <!-- Преобразование HTML кода в php для вывода публикаций с возможностью сортировки -->
<?php $content[] = ['content' =>Html::tag('div', 
                                            Html::tag('div', 
                                                    Html::tag('div', 
                                                            Html::tag('div', 
                                                               Html::a($book->title, ['library/publications', 'id' => $book->id], ['class' => 'profile-link'])
                                                               . ' ' .
                                                               Html::button('В избанное', [ 'onclick' => 'getId('.$book->id.')', 'class' => 'btn btn-primary btn-sm pull-right', 'data-toggle' => 'modal' , 'data-target' => '#modalAdd', ['style' =>['margin' => '0'] ]])
                                                                    
                                                            ,['class' => 'panel-title'])
                                                            
                                                    , ['class' => 'panel-heading'])
                                                    . ' ' .
                                                    Html::tag('div', 
                                                                $book->excerpt
                                                            , ['class' => 'panel-body'])
                                                    
                                            ,['class' => 'panel panel-primary'] )
        
                                        ), ['style' => ['width' => '80%', 'margin' => '0 auto'] ] 
                    ] ?>

<?php endforeach; ?>
    
    <!-- Виджет для списка с сортировкой -->
<?php
    echo Sortable::widget([
        'type' => Sortable::TYPE_LIST,
        'items' =>  $content
    ]);
?>
    
    <div id='pagination' align='center'>
        <?= yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
    </div>
  <?php else : ?>
    <h1 align="center"> Ничего не найдено </h1>
<?php endif; ?>
</div>




<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 align="center" class="modal-title" id="exampleModalLabel">
              <strong> Выберете в какой курс добавить публикацию </strong>
          </h5>
      </div>
        <div id="radioDiv" class="modal-body">
            <?php  ?>
        <?php foreach ($courseList_add as $course) 
        {  ?> 
            <div class="form-check">
                <input onchange="fun(<?php echo $course->id ?>)" id="rad" class="form-check-input" type="radio" name="radioButton">
                <label  class="form-check-label" for="radioButton">
                <?php echo $course->courseName ?>
                </label>
        </div>
       <?php } ?>
            <input id="courseIdHide" type="hidden" name="courseIdHide"> </input>
            <input id="idHide" type="hidden" name="idHide"> </input> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary" onclick="actionBtn()" > Добавить</button>
      </div>
    </div>
  </div>
     <?php  ActiveForm::end();?>
</div>






