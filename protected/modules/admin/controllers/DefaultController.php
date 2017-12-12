<?php

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $this->render('index', array('users' => $users));
    }

}
