<?php

session_start();

if(!isset($_SESSION['id'])){
  header('Location: login.php');
}
/*
echo $_SESSION['subject'];

echo $_SESSION['date'];

echo $_SESSION['time'];
*/
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

<div class="top centered-block">
  <div class="top-div">
    <h1>Programming X English. Sky is Your Limit.</h1>
    <p>At TADA Tech, you can learn both programming and English. With these two skills, you can work freely as a web developer anywhere in the world!</p>
    <button onclick="location.href = 'pick-subject.php';" class="top-book-btn">BOOK A CLASS</button>
  </div>
  <div class="top-div" id="top-img-div"><img src="img/top.jpg" class="top-img"></div>
</div>

<script>
  /*push down the content when nav collapses*/
$(document).ready(function(){
  var selectBody = $('.top');
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