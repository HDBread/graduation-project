<?php

if(!\Yii::$app->user->isGuest)
        {
            \Yii::$app->user->logout();
            
        }