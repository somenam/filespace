<?php
//var_dump($task);
?>

<? if($info):?>
<p style="color: red;"><?= $info; ?></p>
<? endif;?>

<?= CHtml::form('', 'post'); ?>
<div style="">
    <p><?= CHtml::activeLabel($user, 'username') ?></p>
    <p><?= CHtml::activeTextField($user, 'username', array('style' => 'border: 1px solid #ccc;border-radius: 4px;', 'class' => 'form-control')) ?></p>
</div>

<div style="">
    <p></p>
    <!-- Кнопка "регистрация" !-->
    <td><?= CHtml::submitButton('Создать', array('id' => "submit", 'class' => 'btn btn-info btn-xs')); ?></td>
</div>
<?= CHtml::endForm(); ?>


