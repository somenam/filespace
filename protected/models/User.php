<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Andrey
 */
class User extends CActiveRecord {

    public $id;
    public $username;
    public $password;
    
    //0-undefind, 1-user, 2-admin
    public $role = 0;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user';
    }

    /**
     * Правила валидации
     */
    public function rules()
    {
        return array(
            // логин, пароль не должны быть больше 128-и символов
            array('username, password', 'required'),
        );
    }

    public function safeAttributes()
    {
        return array('username', 'password');
    }

    public function attributeLabels()
    {
        return array(
            'username' => 'Логин',
            'password' => 'Пароль',
        );
    }

    public static function getRole($code)
    {
        $roles = array(
            '0' => '',
            '1' => 'Пользователь',
            '2' => 'Администратор'
        );
        return $roles[$code];
    }

    public static function getUser()
    {
        $activity = array();
        $user = Yii::app()->db->createCommand()
                ->select('*')
                ->from('user')
                ->where('id=' . Yii::app()->user->id)
                ->queryRow();
        $activity['code'] = $user['activity'];
        $activity['value'] = User::getActivity($user['activity']);
        return $activity;
    }


public static function valReg($user) {
        if (strlen($user->username) < 3 || strlen($user->username) > 20) {
            return 'Имя дожно быть от 2 до 20 символов';
        }
        return FALSE;
    }


    public static function isAdmin()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'id = ' . Yii::app()->user->id;
        $work = User::model()->find($criteria);
        if ($work->role == 2) {
            return TRUE;
        }
        return FALSE;
    }

}
