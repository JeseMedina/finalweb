<?php 
session_start();
?>
<header>
  <a href=""
    class="logo">HotFood</a>

  <nav class="navbar">
    <a class="active"
      href="#home">Inicio</a>
    <a href="#about">Sobre Nosotros</a>
    <a href="#menu">Menu</a>
    <a href="#order">Ordener</a>
  </nav>

  <div class="icons">
    <span class="user-name">
      <?php
    echo $_SESSION['nombre'];
    ?>
    </span>
    <i class="fas fa-bars"
      id="menu-bars"></i>
    <a href="controller/usuario.php?op=salir"
      class="fas fa-sign-in-alt"></a>
  </div>
</header>