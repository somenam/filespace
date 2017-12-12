<?php

class AdminModule extends CWebModule
{

    public function init()
    {

        // set the layout path
        $this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
        // set the layout
        $this->layout = 'main';
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            $controller->layout = 'mainAdmin';
            if (Yii::app()->user->isGuest) {
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl('user/login/path/admin'));
                //var_dump(Yii::app()->request->hostInfo);
            } else {
                if (!User::isAdmin()) {
                    Yii::app()->request->redirect(Yii::app()->request->getBaseUrl(true).'/site/index');
                }
            }

            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
