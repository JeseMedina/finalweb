<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3480/3480573.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include 'templates/header.php'; ?>
    <!-- <?php include 'templates/home.php'; ?> -->

    <section class="home" id="login">
        <h1>LOGIN</h1>

        <form class="login" action="">
            <div class="input">
                <span>Usuario o Contraseña</span>
                <input type="text" name="txtUsuario">
            </div>
            <div class="input">
                <span>Contraseña</span>
                <input type="password" name="txtContraseña">
            </div>
        </form>
    </section>



    <?php include 'templates/footer.php'; ?>
</body>

</html>