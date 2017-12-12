<h1>Список пользователей</h1>
<?if(!empty($users)):?>
<div style="width: 800px; min-height: 400px;">
    <p></p>
    <p><?= CHtml::link('Заблокированные', array('user/blocked'), array('class' => 'btn btn-info btn-xs', 'style' => 'background: #61A3CB;')); ?>&nbsp;&nbsp;<?= CHtml::link('Внешние', array('user/external'), array('class' => 'btn btn-info btn-xs', 'style' => 'background: #61A3CB;')); ?>&nbsp;&nbsp;<?= CHtml::link('Создать', array('user/create'), array('class' => 'btn btn-info btn-xs', 'style' => 'background: #61A3CB;')); ?></p>
    <p></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Статус</th>
                <th>Роль</th>
                <th>Группа</th>
                <th>Задачи</th>
                <th>Активность</th>
                <th>Время</th>
                <th>Проект</th>
            </tr>
        </thead>
        <? foreach($users as $user):?>



        <tr width ="250px">
            <td width="50px"><?= CHtml::link($user['username'], array('user/view', 'id' => $user['id'])); ?></td>
            <td width="50px"><?= User::getStatus($user['status']); ?></td>
            <td width="50px"><?= User::getRole($user['role']); ?></td>
            <td width="50px"><?= Group::getGroupById($user['group_id']); ?></td>
            <td width="50px"><?= CHtml::link('Задачи', array('task/userTasks', 'id' => $user['id'])); ?></td>
            <td width="50px"><?= User::getActivity($user['activity']); ?></td>
            <td><?= date("H:i:s", $user['activity_time']);?></td>
            <td width="50px">
                <?if($user['taskInfo']):?>
                <?= CHtml::link($user['taskInfo']['prName'], array('project/view', 'id' => $user['taskInfo']['prId'])); ?>
                <?else:?>
                нет
                <?endif;?>
            </td>
        </tr>
        <? endforeach;?>
    </table>
</div>
<?else:?>
<h2>Нет пользователей</h2>
<?endif;?>

