<?php
//var_dump($user);
?>
<div class="panel panel-default" style="width: 400px; min-height: 400px;">
    <?= CHtml::form('', 'post', array('class' => 'form-horizontal')); ?>

   
        <? if($info):?>
    <p style="color: red;"><?= $info; ?></p>
    <? endif;?>
 <p></p>
<div class="form-group">
    старый
    <?= CHtml::activeLabel($user, 'password', array('class' => 'control-label col-sm-2',)) ?>
    <div class="col-sm-10">
        <?= CHtml::activePasswordField($user, 'username', array('value'=>''), array('class' => 'form-control',)) ?>
    </div>
</div>
 <div class="form-group">
     новый
    <?= CHtml::activeLabel($user, 'password', array('class' => 'control-label col-sm-2',)) ?>
    <div class="col-sm-10">
        <?= CHtml::activePasswordField($user, 'email', array('value'=>''), array('class' => 'form-control',)) ?>
    </div>
</div>

        <p><?= CHtml::submitButton('Сохранить', array('id' => "submit", 'class' => 'btn btn-info btn-xs', 'style' => 'background-color: #61A3CB;')); ?></p>

<?= CHtml::endForm(); ?>
</div>
