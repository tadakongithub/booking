<?php

session_start();

if (!isset($_SESSION['admin-id'])){
    header('Location: admin-login.php');
}

require 'db.php';

$stmt = $db->query('SELECT * FROM booking WHERE date >= now() - INTERVAL 1 DAY LIMIT 4');

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>SUBJECT</title>
</head>

<body>

<div class="centered-block admin-block">

<div class="prev-next">
<img src="img/prev.png" class="prev">
<img src="img/next.png" class="next">
</div>

<table class="table ajax-table">
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
</table>

<p class="color-description"><span class="color-square red"></span>=HTML <span class="color-square blue"></span>=CSS <span class="color-square purple"></span>=PHP</p>

</div>

<script>
    $(document).ready(function(){
        $("td").each(function(index, element){
            if($(element).hasClass('HTML')){
                $(element).css({
                    backgroundColor: '#ff6383'
                });
            } else if($(element).hasClass('CSS')){
                $(element).css({
                    backgroundColor: '#4083ff'
                });
            } else if($(element).hasClass('PHP')){
                $(element).css({
                    backgroundColor: '#8363ff'
                });
            }
        });
        
    });

    $(document).ready(function(){

        $(".next").on('click', function(){

        var firstCol = $('.token').attr('id');
            $.ajax({
                url: "admin-next.php",
                type: "post",
                data: {firstCol: firstCol},
                success: function(data){
                    $(".ajax-table").empty();
                    $(".ajax-table").append(data);
                    $("td").each(function(index, element){
                        if($(element).hasClass("HTML")){
                            $(element).css({
                                backgroundColor: "#ff6383"
                            });
                        } else if ($(element).hasClass("CSS")){
                            $(element).css({
                                backgroundColor: "#4083ff"
                            });
                        } else if ($(element).hasClass("PHP")){
                            $(element).css({
                                backgroundColor: "#8363ff"
                            });
                        }
                    });
                }
            });
        });
    });

    $(document).ready(function(){

        $(".prev").on('click', function(){

        var firstCol = $('.token').attr('id');
            $.ajax({
                url: "admin-prev.php",
                type: "post",
                data: {firstCol: firstCol},
                success: function(data){
                    $(".ajax-table").empty();
                    $(".ajax-table").append(data);
                    $("td").each(function(index, element){
                        if($(element).hasClass("HTML")){
                            $(element).css({
                                backgroundColor: "#ff6383"
                            });
                        } else if ($(element).hasClass("CSS")){
                            $(element).css({
                                backgroundColor: "#4083ff"
                            });
                        } else if ($(element).hasClass("PHP")){
                            $(element).css({
                                backgroundColor: "#8363ff"
                            });
                        }
                    });
                }
            });
        });
    });
</script>

</body>

</html>