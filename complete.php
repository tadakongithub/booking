<?php

session_start();

require 'db.php';

if(!isset($_SESSION['id'])){
    header('Location: login.php');
}

if(!isset($_SESSION['subject'])){
    header('Location: index.php');
}

$user_id = $_SESSION['id'];
$date = $_SESSION['date'];
$time = $_SESSION['time'];
$subject = $_SESSION['subject'];

$stmt = $db->query("SELECT * FROM booking_user WHERE id = $user_id");

//send e-mail
while ($record = $stmt->fetch()){

    $name = $record['name'];

    $to = $record['email'];

    $title = "You have booked a class for TADA Tech";

    $message = 'This is TADA Tech. You have successfully booked a class! The details are as follows:<br /><br />';
    $message .= "Date: $date<br>";
    $message .= "Time: $time<br>";
    $message .= "Subject: $subject<br><br>";
    $message .= "Please send me a friend request 10 minutes before your class. In your request, include your user name for TADA Tech.</br></br>";
    $message .= "Your user name: " . $name . "<br>";
    $message .= "My Skype ID: live:jensonnumber1<br><br>";
    $message .= "Be aware that I won't be able to accept your request if you don't include your user name. ";
    $message .= "I will be looking forward to seeing in the class!";

    $header = "From: TADA TECH <jensonnumber1@gmail.com>\r\n";
    $header .= "Reply-To: jensonnumber1@gmail.com\r\n";
    $header .= "Content-type: text/html\r\n";

    mail($to, $title, $message, $header);

    unset($_SESSION['subject']);
    unset($_SESSION['date']);
    unset($_SESSION['time']);

}


?>

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

<div class="complete centered-block">
    <img src="img/success.png" id="success-img">
    <h1>BOOKING SUCCESSFUL</h1>
    <p>We have sent you an e-mail about the class. Follow the instruction in the e-mail so that we can start our class smoothly.</p>
    <a href="index.php">Back to Top</a>
</div>

<script>

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
