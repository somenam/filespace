<?php
$this->pageTitle = Yii::app()->name;
?>
<h1>Добро пожаловать в  <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<div class="bordered5" style="min-height: 300px;">
    <? if(!Yii::app()->user->isGuest):?>
    <p>&nbsp;&nbsp;</p><p>&nbsp;&nbsp;</p>
    <form action=<?= Yii::app()->request->getBaseUrl(true) . "/site/addFile"; ?>  method=post enctype=multipart/form-data>
        <input type="hidden" name="projectId" value=<?= $project->id ?>>
<!--                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />-->
        <input type=file name=uploadfile>
        <button type="submit"><span class="glyphicon glyphicon-save-file"></span></button>
    </form>
    <? endif;?>
</div>
