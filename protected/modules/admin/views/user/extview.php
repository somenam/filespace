<?php //var_dump(count($projects)); ?>
<?if($user != null):?>
<p></p>
<div style="width: 40%;float: left;border: 1px solid #ccc;padding: 6px; border-radius: 5px;">
    <div>
        <table class="table table-striped">
            <thead>
                <tr width ="250px">
                    <th width="50px">Имя</th>
                    <th width="50px">Роль</th>
                    <th width="50px">Изменить пароль</th>
                    <th width="50px">Заблокировать</th>
                </tr>
            </thead>
            <tr width ="250px">
                <td width="50px"><?= $user->username ?></td>
                <td width="50px"><?= User::getRole($user['role']); ?></td>
                <td width="50px"><?= CHtml::link('<span class="glyphicon glyphicon-ok proj_info"></span>', array('user/recPass', 'id' => $user->id)); ?></td>
                <td width="50px"><?= CHtml::link('<span class="glyphicon glyphicon-ok proj_info"></span>', array('user/bloc', 'id' => $user->id, 'status' => '2')); ?></td>
            </tr>
        </table>
    </div>
    <br><br><br>
    <p>Проекты юзера</p>
    <br>
    <div>
        <?if(!empty($actProjects)):?>
        <table class="table table-striped">

            <? foreach($actProjects as $aproject):?>
            <tr width ="250px">
                <td width="50px"><?= $aproject['name']; ?></td>
                <td width="50px"><?= CHtml::link('<span style="color: red;" class="glyphicon glyphicon-remove"></span>', array('project/detouch', 'userId' => $user->id, 'projectId' => $aproject['id'])); ?></td>
            </tr>
            <? endforeach;?>
        </table>
        <?endif;?>
    </div>
</div>

<div style="width: 55%;float: right;border: 1px solid #ccc;padding: 6px; border-radius: 5px;">
    <div>
        <?if(!empty($projects)):?>
        <table class="table table-striped">
            <thead>
                <tr width ="250px">
                    <th width="50px">Имя</th>
                    <th width="50px">статус</th>
                    <th width="50px"></th>
                </tr>
            </thead>

            <? foreach($projects as $project):?>
            <tr width ="250px">
                <td width="50px"><?= $project['name']; ?></td>
                <td width="50px"><?= Project::getStatus($project['status']); ?></td>
                <td width="50px"><?= CHtml::link('<span class="glyphicon glyphicon-pushpin"></span>', array('project/join', 'userId' => $user->id, 'projectId' => $project['id'])); ?></td>
            </tr>
            <? endforeach;?>
        </table>
        <?endif;?>
    </div>
</div>
<?else:?>
<h2>Пользователь отсутствует</h2>
<?endif;?>

