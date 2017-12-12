

<?php
if (isset($info)) {
    echo $info;
}
?>
<div style="width: 300px; min-height: 400px;">
    <?= CHtml::form('', 'post', array('class' => 'form-horizontal')); ?>
    <div class="form-group">
        <?= CHtml::activeLabel($form, 'username', array('class' => 'control-label col-sm-2',)); ?>
        <div class="col-sm-10">
            <?= CHtml::activeTextField($form, 'username', array('class' => 'form-control')) ?>
        </div>
    </div>
    <div class="form-group">
        <?= CHtml::activeLabel($form, 'password', array('class' => 'control-label col-sm-2',)); ?>
        <div class="col-sm-10">
            <?= CHtml::activePasswordField($form, 'password', array('class' => 'form-control',)) ?>
        </div>
    </div>
    <?= CHtml::submitButton('Войти', array('id' => "submit", 'class' => 'btn btn-info btn-xs submit')); ?>
 

    <?= CHtml::endForm(); ?>

</div>
