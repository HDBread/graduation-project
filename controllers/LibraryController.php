<?php

namespace app\controllers;

use app\models\Library;
use \app\models\CourseList;
use \app\models\Course;
use app\models\PublicationFindForm;
use app\models\Signup;
use app\models\Login;
use app\models\Cabinet;
use app\controllers\AppController;

class LibraryController extends AppController {
    
    public function actionIndex() 
    {   
            $query = Library::find()->select('id, title, excerpt');
            $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'pageSizeParam' => false, 'forcePageParam' => false]);
            $books = $query->offset($pages->offset)->limit($pages->limit)->all();
            
            //Поиск всех курсов для вывода при добавлении методички в курс
            $query_cource_add = CourseList::find()
                ->Where(['id_user' => \Yii::$app->user->identity->id])
                ->all();
            
            if(isset($_POST['courseIdHide']) && isset($_POST['idHide']))
            {
                $courseId = \Yii::$app->request->post('courseIdHide');
                $publicationId = \Yii::$app->request->post('idHide');
                $course_model = new Course();
                $course_model->addPublicationInCourse($courseId, $publicationId);
                \Yii::$app->session->setFlash('success', 'Добавление методического пособия в курс прошло успешно');
                return $this->goHome();
            }

            return $this->render('index', ['books' => $books, 'pages' => $pages, 'courseList_add' => $query_cource_add]);
    }
    
    public function actionLogout()
    {
        $this->render('logout');
        return $this->redirect(['index']);
    }
    
    public function actionPublications() {
        $id = \Yii::$app->request->get('id');
        $publication = Library::findOne($id);
        if (empty($publication)) throw new \yii\web\HttpException(404, 'Page doesn\'t exist ');
        return $this->render('publications', compact('publication'));   
    }
    
    //Экшен для поиска по названию/ключевым словам
    public function actionSearch()
    {
        $search = \Yii::$app->request->get('name_search');
        if ($search == '')
        {
            return $this->redirect('/');
        }
        
        $replaceSpace_search = str_replace(" ", "", $search);
        
        $query_search = Library::find()
                ->select('id, title, excerpt'
                )->where(['like', 'replace(title," ", "")',$replaceSpace_search])
                ->orWhere(['like', 'replace(keywords," ", "")',$replaceSpace_search]);  
        $pages = new \yii\data\Pagination(['totalCount' => $query_search->count(), 'pageSize' => 4, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $books = $query_search->offset($pages->offset)->limit($pages->limit)->all();
        
        //Поиск всех курсов для вывода при добавлении методички в курс
            $query_cource_add = CourseList::find()
                ->Where(['id_user' => \Yii::$app->user->identity->id])
                ->all();
        
        return $this->render('index', ['books' => $books, 'pages' => $pages,'search' => $search, 'courseList_add' => $query_cource_add]) ;    
        
    }
    
    //Экшен для авторизации
    public function actionLogin()
    {
        //Если пользователь авторизирован, то его перенаправят на главную сраницу
        if(!\Yii::$app->user->isGuest)
        {
           return $this->goHome(); 
        }
        
        $login_model = new Login();
        
        if(\Yii::$app->request->post('Login'))
        {
           $login_model->attributes = \Yii::$app->request->post('Login'); 
           
           if($login_model->validate())
           {
               \Yii::$app->user->login($login_model->getUser());
               \Yii::$app->session->setFlash('success', 'Авторизация прошла успешно.');
               return $this->goHome();
           }
        }
        return $this->render('login', ['login_model' => $login_model]);
    }
   //Экшен для регистрации
   public function actionSignup()
    {
       $model = new Signup();
       
       if(isset($_POST['Signup']))
       {
           $model->attributes = \Yii::$app->request->post('Signup');
           
          if($model->validate() && $model->signup())
          {
              \Yii::$app->session->setFlash('success', 'Регистрация прошла успешно.');
              return $this->goHome();
          }
       }
       
        return $this->render('signup', ['model' => $model]);
    }
    
    public function actionCabinet()
    {
        //Если пользователь авторизирован, то его перенаправят на главную сраницу
        if(\Yii::$app->user->isGuest)
        {
           return $this->goHome(); 
        }
        
        $cabinet_form = new Cabinet();
        
            $cabinet_form->attributes = \Yii::$app->request->post('Cabinet'); 
        
        return $this->render('cabinet',['cabinet_model' => $cabinet_form]);
    }
    
    public function actionCourses()
    {
        if(\Yii::$app->user->isGuest)
        {
           return $this->goHome(); 
        }
        
        $courses = CourseList::find()
                ->Where(['id_user' => \Yii::$app->user->identity->id])
                ->all();
        $course_model = new CourseList();
        
        if(isset($_POST['CourseList']))
       {
           $course_model->attributes = \Yii::$app->request->post('CourseList');
           
          if($course_model->validate() && $course_model->createCourse())
          {
              return $this->goHome();
          }
       }
        return $this->render('courses', ['courses' => $courses, 'course_model' => $course_model]);
    }
    
    public function actionCourse()
    {
        if(\Yii::$app->user->isGuest)
        {
           return $this->goHome(); 
        }
        
        $id = \Yii::$app->request->get('id');
        $course = CourseList::findOne($id);
        $publications = Course::find()
                ->where(['id_courseList' => $id])
                ->all();
        
        if (empty($course)) throw new \yii\web\HttpException(404, 'Page doesn\'t exist ');
        
        return $this->render('course', ['course' => $course, 'publications' => $publications]);
    }
}
    