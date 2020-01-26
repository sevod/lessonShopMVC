<?php
    class NewsController{
        public function actionIndex(){
            echo 'NewsController actionIndex / list of news';
            return true;
        }

        public function actionView(){
            echo 'NewsController actionView / one new';
            return true;
        }
    }
