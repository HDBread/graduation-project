<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\sortable\Sortable;
use app\models\CourseList;
use yii\helpers\ArrayHelper;

?>


<h1> Курс: <?php echo $course->courseName ?> </h1>

<div>
<?php if(!empty($publications)): ?>
    
<?php $content = array();?>

<?php foreach($publications as $publication): ?>
<?php // var_dump($publication);die();?>

<?php $library_publication = $publication->getLibrarys(); 

?>


    <!-- Преобразование HTML кода в php для вывода публикаций с возможностью сортировки -->
<?php $content[] = ['content' =>Html::tag('div', 
                                            Html::tag('div', 
                                                    Html::tag('div', 
                                                            Html::tag('div', 
                                                               Html::a($library_publication->title, ['library/publications', 'id' => $publication->id], ['class' => 'profile-link'])     
                                                            ,['class' => 'panel-title'])
                                                            
                                                    , ['class' => 'panel-heading'])
                                                    . ' ' .
                                                    Html::tag('div',
                                                                $library_publication->excerpt
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
   
  <?php else : ?>
    <h2 align="center"> Курс пуст </h2>
<?php endif; ?>
</div>
    

