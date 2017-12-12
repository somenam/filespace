<h1>Список пользователей</h1>
<?if(!empty($users)):?>
<div style="width: 800px; min-height: 400px;">
    <p></p>
    <table class="table table-striped">
     <thead>
    <tr>
        <th>Имя</th>
        <th>Статус</th>
        <th>Роль</th>
    </tr>
     </thead>
    <? foreach($users as $user):?>
   
    
    
    <tr width ="250px">
        <td width="50px"><?= CHtml::link($user['username'], array('user/extView', 'id' => $user['id'])); ?></td>
        <td width="50px"><?= User::getStatus($user['status']); ?></td>
        <td width="50px"><?= User::getRole($user['role']); ?></td>
    </tr>
    <? endforeach;?>
</table>
    </div>
<?else:?>
<h2>Нет пользователей</h2>
<?endif;?>

