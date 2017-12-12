<?php //var_dump($user);?>
<?if($user != null):?>
<p></p>
<div style="width: 90%">
    <p style="color: red;">
        <?if(isset($info)):?>
        <?= $info;?>
        <?endif;?>
    </p>
    <table class="table table-striped">
        <thead>
            <tr width ="250px">
                <th width="50px">Имя</th>
                <th width="50px">Роль</th>
                <th width="50px">Email</th>
                <th width="50px">Jabber</th>
                <th width="50px">
                    Назначить 
                </th>
                <th width="50px">Изменить пароль</th>
                <th width="50px">Заблокировать</th>
                <th width="50px">Время</th>
            </tr>
        </thead>
        <tr width ="250px">
            <td width="50px"><?= $user->username ?></td>
            <td width="50px"><?= User::getRole($user['role']); ?></td>
            <td width="50px"><?= $user->email ?></td>
            <td width="50px"><?= $user->jabber ?></td>
            <td width="50px">
                <?if(!$user->group_id):?>
                <p><?= CHtml::link('Администратор', array('user/setRole', 'id' => $user->id, 'role' => 2)); ?></p>
                <p><?= CHtml::link('Менеджер', array('user/setRole', 'id' => $user->id, 'role' => 3)); ?></p>
                <p><?= CHtml::link('Пользователь', array('user/setRole', 'id' => $user->id, 'role' => 1)); ?></p>
                <p><?= CHtml::link('Внешний', array('user/setRole', 'id' => $user->id, 'role' => 4)); ?></p>
                <?else:?>
                Пользователь в группе
                <?endif;?>
            </td>
            <td width="50px"><?= CHtml::link('<span class="glyphicon glyphicon-ok proj_info"></span>', array('user/recPass', 'id' => $user->id)); ?></td>
            <td width="50px"><?= CHtml::link('<span class="glyphicon glyphicon-ok proj_info"></span>', array('user/bloc', 'id' => $user->id, 'status' => '2')); ?></td>
            <td> 
                <?if($user != null):?>
                <? foreach($time as $value):?>
                <p><?= $value['date_mark']?>&nbsp;&nbsp;<?= number_format($value['time'], 2);?></p>
                <? endforeach;?>
                <?endif;?>
            </td>
        </tr>
    </table>
</div>
<?else:?>
<h2>Пользователь отсутствует</h2>
<?endif;?>

