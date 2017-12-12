<h1>Список пользователей</h1>
<?if(!empty($users)):?>
<div style="width: 800px; min-height: 400px;">
    <p></p>
    <p><?= CHtml::link('Заблокированные', array('user/blocked'), array('class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?></p>
    <p></p>
    <table class="table table-striped">
     <thead>
    <tr>
        <th>Имя</th>
        <th>Статус</th>
        <th>Роль</th>
        <th>Разблокировать</th>
    </tr>
     </thead>
    <? foreach($users as $user):?>
   
    
    
    <tr width ="250px">
        <td width="50px"><?= CHtml::link($user['username'], array('user/view', 'id' => $user['id'])); ?></td>
        <td width="50px"><?= User::getStatus($user['status']); ?></td>
        <td width="50px"><?= User::getRole($user['role']); ?></td>
        <td width="50px"><?= CHtml::link('<span class="glyphicon glyphicon-ok proj_info"></span>', array('user/bloc', 'id' => $user['id'], 'status' => '1')); ?></td>
    </tr>
    <? endforeach;?>
</table>
    </div>
<?else:?>
<h2>Нет пользователей</h2>
<?endif;?>

