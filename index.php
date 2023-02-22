<?php

session_start();

if ($_SESSION['tipo'] == 'admin') {
    header("Location: admin/platos.php");
} elseif  ($_SESSION['tipo'] == 'cliente') {
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible"
    content="IE=edge">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>HotFood</title>
  <link rel="icon"
    href="https://cdn-icons-png.flaticon.com/128/3480/3480573.png">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet"
    href="css/style.css">
</head>

<body>
  <?php
    include 'templates/header.php';
    include 'templates/home.php';
    include 'templates/about.php';
    include 'templates/menu.php';
    include 'templates/order.php';
    include 'templates/footer.php';
    ?>

  <script src="https://code.jquery.com/jquery-3.6.3.js"
    integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>

</html>
<?php
}
else{ 
  header("Location: login.html");
}