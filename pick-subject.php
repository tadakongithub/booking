<?php
    session_start();

    if(!isset($_SESSION['id'])){
      header('Location: login.php');
  }

    require 'db.php';

    if(isset($_POST['subject'])){
        $subject = $_POST['subject'];
        $_SESSION['subject'] = $subject;
        header('Location: pick_time.php');
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
    <title>SUBJECT</title>
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


<div class="flex-pick-subject centered-block">

<form action="" method="post" class="flex-item-sub">
<img src="img/html.png" class="flex-sub-img">
<div class="flex-sub-p-btn">
<p>In this course, you can learn the fundamentals of HTML, which is a mark-up language
  used to define page layout, along with English vocabs and grammar points.</p>
<button type="submit" name="subject" value="HTML">HTML & English</button>
</div>
</form>

<form action="" method="post" class="flex-item-sub">
<img src="img/css.png" class="flex-sub-img">
<div class="flex-sub-p-btn">
<p>In this course, you can learn the fundamentals of CSS, which is a style sheet language
  used for styling webpages , along with English vocabs and grammar points.</p>
<button type="submit" name="subject" value="CSS">CSS & English</button>
</div>
</form>

<form action="" method="post" class="flex-item-sub">
<img src="img/php.png" class="flex-sub-img">
<div class="flex-sub-p-btn">
<p>In this course, you can learn the fundamentals of PHP, which is a programming language 
  for web development, along with English vocabs and grammar points.</p>
<button type="submit" name="subject" value="PHP">PHP & English</button>
</div>
</form>

</div>

</body>

</html>