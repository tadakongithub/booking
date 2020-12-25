<?php
    session_start();

    if(!isset($_SESSION['id'])){
        header('Location: login.php');
    }

    require 'db.php';

    $sql = "SELECT * FROM booking WHERE date >= now() /*- INTERVAL 1 DAY*/LIMIT 4";

    $stmt = $db->query($sql);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //echo $orders[0]['date'];

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
    <title>TIME</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="" class="logo_2"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="booked.php">BOOKED<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">LOGOUT</a>
      </li>
    </ul>
  </div>
</nav>



<div class="centered-block">

<div class="prev-next">
<img src="img/prev.png" class="prev">
<img src="img/next.png" class="next">
</div>

<table class="table ajax-table">

<tr class="token" id="<?php echo $orders[0]['date'];?>">
    <th></th>
    <?php foreach ($orders as $key => $val) :?>
    <th><?php echo date('m/d D', strtotime($val['date']));?></th>
    <?php endforeach ;?>
</tr>

<tr>
    <td>10AM</td>
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
    <td>11AM</td>
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
    <td>12AM</td>
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
    <td>13AM</td>
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


</table>

<div class="back-to-sub"><a href="pick-subject.php">Back to Subject</a></div>

</div>

<script>
$(document).ready(function(){

    $(".next").on('click', function(){

        var firstCol = $('.token').attr('id');
        $.ajax({
            url: "next_table.php",
            type: "post",
            data: {firstCol: firstCol},
            success: function(data){
                $(".ajax-table").empty();
                $(".ajax-table").append(data);
            }
        });
    });
});

$(document).ready(function(){

$(".prev").on('click', function(){

    var firstCol = $('.token').attr('id');
    $.ajax({
        url: "prev_table.php",
        type: "post",
        data: {firstCol: firstCol},
        success: function(data){
            $(".ajax-table").empty();
            $(".ajax-table").append(data);
        }
    });
});
});


  /*push down the content when nav collapses*/
$(document).ready(function(){
  var selectBody = $('.centered-block');
var selectNavbarCollapse = $('.navbar-collapse');

var heightNavbarCollapsed = $('.navbar').outerHeight(true);
var heightNavbarExpanded = 0;

paddingSmall();

selectNavbarCollapse.on('show.bs.collapse', function () {
  if (heightNavbarExpanded == 0 ) heightNavbarExpanded = heightNavbarCollapsed + $(this).outerHeight(true);
  paddingGreat();
})
selectNavbarCollapse.on('hide.bs.collapse', function () {
  paddingSmall();
})

$(window).resize( function () {
  if (( document.documentElement.clientWidth > 767 ) && selectNavbarCollapse.hasClass('in') ) {
    selectNavbarCollapse.removeClass('in').attr('aria-expanded','false');
    paddingSmall();
  }
});

function paddingSmall() {
  heightNavbarExpanded = 0;
  selectBody.css('margin-top', heightNavbarExpanded + 'px');
}
function paddingGreat() {
  selectBody.css('margin-top', heightNavbarExpanded + 'px');
}
})

</script>

</body>

</html>