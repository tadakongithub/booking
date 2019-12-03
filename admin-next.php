<?php

require 'db.php';

if(isset($_POST['firstCol'])){
    $firstCol = $_POST['firstCol'];
    $newFirstCol = date('Y-m-d', strtotime($firstCol. ' + 4 days'));
    $sql = "SELECT * FROM booking WHERE date >= ? LIMIT 4";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $newFirstCol, PDO::PARAM_STR);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<tr class="token" id="<?php echo $orders[0]['date'];?>">
        <th></th>
        <?php foreach($orders as $val) :?>
        <th><?php echo date('m/d', strtotime($val['date']));?></th>
        <?php endforeach ;?>
    </tr>
    <tr>
        <td>10 AM</td>
        <?php foreach($orders as $val) :?>
        <?php $user_id = $val['10_user'];?>
        <?php if($user_id != 'A'):?>
        <?php $stmt1 = $db->query("SELECT * FROM user WHERE id = $user_id");?>
        <?php while ($record1 = $stmt1->fetch()):?>
        <td class="sub-td <?php echo $val['10sub'];?>"><?php echo $record1['name'];?></td>
        <?php endwhile;?>
        <?php else :?>
        <td></td>
        <?php endif ;?>
        <?php endforeach ;?>
    </tr>
    <tr>
        <td>11 AM</td>
        <?php foreach($orders as $val) :?>
        <?php $user_id = $val['11_user'];?>
        <?php if($user_id != 'A'):?>
        <?php $stmt1 = $db->query("SELECT * FROM user WHERE id = $user_id");?>
        <?php while ($record1 = $stmt1->fetch()):?>
        <td class="sub-td <?php echo $val['11sub'];?>"><?php echo $record1['name'];?></td>
        <?php endwhile;?>
        <?php else :?>
        <td></td>
        <?php endif ;?>
        <?php endforeach ;?>
    </tr>
    <tr>
        <td>12 PM</td>
        <?php foreach($orders as $val) :?>
        <?php $user_id = $val['12_user'];?>
        <?php if($user_id != 'A'):?>
        <?php $stmt1 = $db->query("SELECT * FROM user WHERE id = $user_id");?>
        <?php while ($record1 = $stmt1->fetch()):?>
        <td class="sub-td <?php echo $val['12sub'];?>"><?php echo $record1['name'];?></td>
        <?php endwhile;?>
        <?php else :?>
        <td></td>
        <?php endif ;?>
        <?php endforeach ;?>
    </tr>
    <tr>
        <td>13 PM</td>
        <?php foreach($orders as $val) :?>
        <?php $user_id = $val['13_user'];?>
        <?php if($user_id != 'A'):?>
        <?php $stmt1 = $db->query("SELECT * FROM user WHERE id = $user_id");?>
        <?php while ($record1 = $stmt1->fetch()):?>
        <td class="sub-td <?php echo $val['13sub'];?>"><?php echo $record1['name'];?></td>
        <?php endwhile;?>
        <?php else :?>
        <td></td>
        <?php endif ;?>
        <?php endforeach ;?>
    </tr>