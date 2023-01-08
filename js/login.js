$("#frmAcceso").on('submit', function(e) {

    e.preventDefault();
    let user = $("#user").val();
    let contrasena = $("#contrasena").val();

    $.post("../controller/usuario.php?op=verificar",
        { 'user': user, 'contrasena': contrasena },
        function (data) {
            if (data != "null") {
                $(location).attr("href", "index.php");
            } else {
                console.log("Usuario y/o Contraseña incorrectos");
            }
        }
    );
});