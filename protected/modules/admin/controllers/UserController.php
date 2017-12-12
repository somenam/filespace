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

    public function actionIndex() {
        
    }
    
    public function actionUpdate() {
        $id = Yii::app()->user->id;
        $user = User::model()->findByPk($id);
        if (!empty($_POST['User'])) {
            $user->username = $_POST['User']['username'];
            if ($info = User::valReg($user)) {
                $this->render("update", array('user' => $user, 'info' => $info));
                return;
            }

            $user->save();
            $this->render("update", array('user' => $user, 'info' => 'Логин успешно изменен'));
        } else {
            $this->render("update", array('user' => $user, 'info' => FALSE));
        }
    }
    
    public function actionAcces() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'role=1';
        $user = User::model()->find($criteria);
        if (!empty($_POST['User'])) {
            $user->username = $_POST['User']['username'];
            if ($info = User::valReg($user)) {
                $this->render("update", array('user' => $user, 'info' => $info));
                return;
            }

            $user->save();
            $this->render("update", array('user' => $user, 'info' => 'Логин успешно изменен'));
        } else {
            $this->render("update", array('user' => $user, 'info' => FALSE));
        }
    }
    
    public function actionChPass() {
        //$user = User::model()->findByPk(Yii::app()->user->id);
        $user = User::model()->findByPk($_GET['id']);
        if (!empty($_POST['User'])) {
            
            if (md5($_POST['User']['username']) == $user->password) {
                $user->password = md5($_POST['User']['email']);
                $user->save();
                $this->render("change", array('user' => $user, 'info' => 'Пароль успешно изменен'));
            } else {
                $this->render("change", array('user' => $user, 'info' => 'Неверный пароль'));
            }
        } else {
            $this->render("change", array('user' => $user, 'info' => FALSE));
        }
    }
}
