<?php

require 'db.php';

if(isset($_POST['firstCol'])){
    $firstCol = $_POST['firstCol'];
    $tomorrow = date('Y-m-d', strtotime(date('Y-m-d'))+60*60*24);
    if($firstCol > $tomorrow){
        $newFirstCol = date('Y-m-d', strtotime($firstCol. ' - 4 days'));
    } else {
        $newFirstCol = $tomorrow;
    }
    
    $sql = "SELECT * FROM booking WHERE date >= ? LIMIT 4";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $newFirstCol, PDO::PARAM_STR);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>



<tr class="token" id="<?php echo $orders[0]['date'];?>">
    <th></th>
    <?php foreach ($orders as $val) :?>
    <th><?php echo date('m/d D', strtotime($val['date'])); ?></th>
    <?php endforeach ;?>
</tr>

<tr>
    <td>10時</td>
    <?php foreach ($orders as $val) :?>
    <td>
    <?php if($val['10_user'] == 'A'):?>
    <a href="confirm.php?date=<?php echo $val['date'] . "&time=10";?>"><img src="img/avail.png" class="table-icon"></a>
    <?php else :?>
    <img src="img/unavail.png" class="table-icon">
    <?php endif ;?>
    </td>
    <?php endforeach ;?>
</tr>

<tr>
    <td>11時</td>
    <?php foreach ($orders as $val) :?>
    <td>
    <?php if($val['11_user'] == 'A'):?>
    <a href="confirm.php?date=<?php echo $val['date'] . "&time=11";?>"><img src="img/avail.png" class="table-icon"></a>
    <?php else :?>
    <img src="img/unavail.png" class="table-icon">
    <?php endif ;?>
    </td>
    <?php endforeach ;?>
</tr>

<tr>
    <td>12時</td>
    <?php foreach ($orders as $val) :?>
    <td>
    <?php if($val['12_user'] == 'A'):?>
    <a href="confirm.php?date=<?php echo $val['date'] . "&time=12";?>"><img src="img/avail.png" class="table-icon"></a>
    <?php else :?>
    <img src="img/unavail.png" class="table-icon">
    <?php endif ;?>
    </td>
    <?php endforeach ;?>
</tr>

<tr>
    <td>13時</td>
    <?php foreach ($orders as $val) :?>
    <td>
    <?php if($val['13_user'] == 'A'):?>
    <a href="confirm.php?date=<?php echo $val['date'] . "&time=13";?>"><img src="img/avail.png" class="table-icon"></a>
    <?php else :?>
    <img src="img/unavail.png" class="table-icon">
    <?php endif ;?>
    </td>
    <?php endforeach ;?>
</tr>