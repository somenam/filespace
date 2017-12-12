<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectFile
 *
 * @author Andrey
 */
class File extends CActiveRecord {

    public $id;
    public $date;
    public $path;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'file';
    }

    /**
     * Правила валидации
     */
    public function rules() {
        return array(
        );
    }

    public function safeAttributes() {
        
    }

    public function attributeLabels() {
        return array(
            'path' => 'Path',
        );
    }

}
