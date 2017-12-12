<div class="panel panel-default" style="width: 400px; min-height: 400px;">
    <?= CHtml::form('', 'post', array('class' => 'form-horizontal')); ?>

   
        <? if($info):?>
    <p style="color: red;"><?= $info; ?></p>
    <? endif;?>
 <p></p>
<div class="form-group">
    <?= CHtml::activeLabel($user, 'username', array('class' => 'control-label col-sm-2',)) ?>
    <div class="col-sm-10">
        <?= CHtml::activeTextField($user, 'username', array('class' => 'form-control',)) ?>
    </div>
</div>
<div class="form-group">
    <?= CHtml::activeLabel($user, 'email', array('class' => 'control-label col-sm-2',)) ?>
    <div class="col-sm-10">
        <?= CHtml::activeTextField($user, 'email', array('class' => 'form-control',)) ?>
    </div>
</div>
 <div class="form-group">
    <?= CHtml::activeLabel($user, 'jabber', array('class' => 'control-label col-sm-2',)) ?>
    <div class="col-sm-10">
        <?= CHtml::activeTextField($user, 'jabber', array('class' => 'form-control',)) ?>
    </div>
</div>
        <p><?= CHtml::submitButton('Сохранить', array('id' => "submit", 'class' => 'btn btn-info btn-xs', 'style' => 'background-color: #61A3CB;')); ?></p>

<?= CHtml::endForm(); ?>
        <p><?= CHtml::link('Изменить пароль', array('user/chPass'), array('class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?></p>
</div>
