<?php
    session_start();

    $id = $_SESSION['id'];

    require 'db.php';

    $stmt = $db->query("SELECT * FROM booking WHERE (10_user = $id OR 11_user = $id OR 12_user = $id OR 13_user = $id) AND date >= now() - INTERVAL 1 DAY");

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
            <title>TOP</title>
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

<div class="booked">
<?php if(empty($orders)):?>
  <p>There are no booked classes at the moment.</p>
  <?php else :?> 
<?php foreach ($orders as $key => $val) :?>
<?php for($i=10;$i<=13;$i++) :?>
<?php if($val[$i.'_user'] == $id):?>
course: <?php echo $val[$i.'sub'];?><br>
date: <?php echo $val['date'];?><br>
time: <?php echo $i;?><br><hr>
<?php endif ;?>
<?php endfor ;?>
<?php endforeach;?>
<?php endif ;?>
<a href="index.php" class="to-index">&laquo;Back to Home</a>
</div>

</body>

</html>
