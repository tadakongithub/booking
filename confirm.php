<?php

session_start();

require 'db.php';

if(!isset($_SESSION['id'])){
    header('Location: login.php');
}


if(empty($_SESSION['subject'])){
    $message = "You haven't chosen a subject.";
}


if(isset($_GET['date']) && isset($_GET['time'])){
    $date = $_GET['date'];
    $time = $_GET['time'];
} else {
    echo 'I\'m sorry, there was an error.';
}

if($_POST['confirm-booking']){
    if(empty($_POST['subject'])){
        $message = "Oops! You didn't choose a subject";
    } else {

        $id = $_POST['id'];
        $subject = $_POST['subject'];
        $date = $_POST['date'];
        $time = $_POST['time'];

    //update statement differs depending on the chosen time slot
        for($i=10;$i<=13;$i++){
            if($time == $i){
                $sql = "UPDATE booking SET ".$i."_user = ?, ".$i."sub = ? WHERE date = ?";
            }
        }

    //Checking if the chose slot of the chose date is available
        for($i=10;$i<=13;$i++){
            if($time == $i){
            
                $stmt1 = $db->prepare("SELECT * FROM booking WHERE date = ? AND ".$i."_user = ?");
                $stmt1->execute(array($date, "A"));
           
                if($already_booked = $stmt1->fetch()){
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(1, $id, PDO::PARAM_STR);
                    $stmt->bindParam(2, $subject, PDO::PARAM_STR);
                    $stmt->bindParam(3, $date, PDO::PARAM_STR);
                    $stmt->execute();
                    $_SESSION['date'] = $date;
                    $_SESSION['time'] = $time;
                    header('Location: complete.php');
                } else {
                    $message = 'Someone has already booked this time slot.';
                }
            }
        }    
    }    
}


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



<form id="confirm-form" class="centered-block" action="" method="post">
    <h3><?php echo $_SESSION['subject'];?> COURSE</h3>
    <hr class="confirm-hr">
    <h5>DATE</h5>
    <div><?php echo $date;?></div>
    <br>
    <h5>TIME</h5>
    <div><?php echo $time;?></div>
    <br>
    <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
    <input type="hidden" name="subject" id="course" value="<?php echo $_SESSION['subject'];?>" readonly>
    <input type="hidden" name="date" id="date" value="<?php echo $date;?>" readonly>
    <input type="hidden" name="time" id="time" value="<?php echo $time;?>" readonly>
    <input type="submit" name="confirm-booking" value="Confirm" id="confirm-btn">
</form>


<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo $message;?></p>
      </div>
      <div class="modal-footer">
        <button onclick="location.href = 'pick-subject.php';" type="button" class="btn btn-primary">Go pick a subject</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php if(!isset($_SESSION['subject'])):?>
<script>
    $(document).ready(function(){
        $('#myModal').modal('show');
    });
    
</script>
<?php endif ;?>
    
</body>

</html>
