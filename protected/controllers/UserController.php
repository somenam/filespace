<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author Andrey
 */
class UserController extends Controller {

    /**
     * Метод входа на сайт
     * 
     * Метод в котором мы выводим форму авторизации
     * и обрабатываем её на правильность.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
    }

    public function actionLogin() {
        $form = new User();
        if (!empty($_POST['User'])) {
            $form->attributes = $_POST['User'];
            $identity = new UserIdentity($form->username, $form->password);
            if ($identity->authenticate()) {
                Yii::app()->user->login($identity);

                if (Yii::app()->user->role == 1) {
                    Yii::app()->request->redirect($this->createUrl('site/index'));
                } else if (Yii::app()->user->role == 2) {
                    Yii::app()->request->redirect($this->createAbsoluteUrl('admin/default'));
                }
            } else {
                $this->render('login', array('form' => $form, 'info' => 'Неверный логин или пароль'));
            }
        } else {

            $this->render('login', array('form' => $form, 'info' => FALSE));
        }
    }

    /**
     * Метод выхода с сайта
     * 
     * Данный метод описывает в себе выход пользователя с сайта
     * Т.е. кнопочка "выход"
     */
    public function actionLogout() {
        
    }
}
