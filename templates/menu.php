<!-- <?php
include_once "../config/conexion.php";
$sentencia = $bd->query("select * from platos");
$platos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?> -->

<section class="menu" id="menu">

    <h1 class="heading"> NUestro menu </h1>

    <div class="box-container">
        <?php
        foreach ($platos as $dato) {
        ?>
            <div class="box">
                <div class="image">
                    <img src="<?php echo $dato->imagen ?>" alt="">
                </div>
                <div class="content">
                    <h3><?php echo $dato->nombre; ?></h3>
                    <span class="price">$<?php echo $dato->precio; ?></span>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>