<h1>Рейтинг пользователей</h1>
<?if(!empty($usersRate)):?>
<div style="width: 70%;float: left;">
    <p id="per_info" data-info="<?= $period; ?>"></p>
    <p>
        <?= CHtml::link('Месяц', array('user/rateList/per/1'), array('id' => '1', 'class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?>
        <?= CHtml::link('2 Месяца', array('user/rateList/per/2'), array('id' => '2','class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?>
        <?= CHtml::link('3 Месяца', array('user/rateList/per/3'), array('id' => '3','class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?>
        <?= CHtml::link('4 Месяца', array('user/rateList/per/4'), array('id' => '4','class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?>
        <?= CHtml::link('5 Месяцев', array('user/rateList/per/5'), array('id' => '5','class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?>
        <?= CHtml::link('6 Месяцев', array('user/rateList/per/6'), array('id' => '6','class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?>
        <?= CHtml::link('Весь период', array('user/rateList'), array('id' => '0','class' => 'btn btn-info btn-xs', 'style' => '    background: #61A3CB;')); ?>
    </p>

    <p></p>
    <table class="table table-striped">
        <thead>
            <tr width ="250px">
                <th width="50px">Пользователь</th>
                <th width="50px">Время</th>
                <th width="50px">Проекты</th>

            </tr>
        </thead>
        <? foreach($usersRate as $rate):?>



        <tr width ="250px">
            <td width="50px"><?= $rate['username']; ?></td>
            <td width="50px"><?= TaskTime::timeFormat(number_format($rate['time'], 2)) ?></td>
            <td width="50px"><button class="proj_info btn btn-info btn-xs" style="background: #61A3CB;" id="<?= $rate['id']; ?>">Просмотр</button></td>
        </tr>
        <? endforeach;?>
    </table>
</div>

<div style="width: 29%; float: right;">
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr width ="250px">
                <th width="50px">Проект</th>
                <th width="50px">Время</th>
            </tr>
        </thead>
        <tbody id="projects">
        
        </tbody>
    </table>
</div>
<div style="clear: both;"></div>
<?else:?>
<h2>Нет пользователей</h2>
<?endif;?>

<script>
    $(document).ready(function () {
        var per = $('#per_info').attr("data-info");
        $('#'+per).css('border', '2px solid red');
        $('.proj_info').click(function () {
            $.ajax({
                url: '<?= Yii::app()->request->getBaseUrl(true).'/admin/project/getProjects'; ?>',
                type: 'POST',
                dataType: 'text',
                data: {id: $(this).attr("id"), period: $('#per_info').attr("data-info")},
                success: function (group) {
                    $("#projects").empty();
                    var res = JSON.parse(group);
                    for (var i = 0; i < res.length; i++) {
                        var time = res[i]['time'];
                        $('#projects').append('<tr><td>' + res[i]['prName'] + '</td><td>' + time + '</td></tr>');

                    }
                }
            });
        });
    });
</script>
