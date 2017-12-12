<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileComponent
 *
 * @author Andrey
 */
class FileComponent {

    public static $dir = 'files/';
    
    public static function addFile() {
        //$path = Yii::getPathOfAlias('webroot') . '/' . FileComponent::$dir . $_GET['name'];
        $uploaddir = Yii::getPathOfAlias('webroot') . '/' . FileComponent::$dir;
        $name = $_FILES['uploadfile']['name'];
        if (file_exists($uploaddir . $name)) {
            $name = time() . $name;
        }
        
        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploaddir . $name)) {
//            $file = new File();
//            $file->date = time();
//            $file->path = $uploaddir . $name;
//            $file->save();
            return array(
                'download' => Yii::app()->request->getBaseUrl(true) . '/site/download/name/' . $name,
                'delete' => Yii::app()->request->getBaseUrl(true) . '/site/delete/name/' . $name,
            ); 
        } else {
            return array(
                'download' => 'error',
                'delete' => 'error',
            );
        }
    }

    public static function deleteFile($id) {
        $file = ProjectFile::model()->findByPk($id);
        $uploaddir = Yii::getPathOfAlias('webroot') . '/' . FileComponent::$dir;
        $path = $uploaddir . $file['path'];
        if (file_exists($path)) {
            unlink($path);
        }
        $file->delete();
        return true;
    }

    public static function getDownloadLink($file) {
        return '<a href="' . Yii::app()->request->getBaseUrl(true) . '/' . FileComponent::$dir . $file . '" download><span class="glyphicon glyphicon-floppy-save"></span></a>';
    }



}
