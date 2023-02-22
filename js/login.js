$("#frmAcceso").on('submit', function (e) {

    e.preventDefault();
    let user = $("#user").val();
    let contrasena = $("#contrasena").val();

    $.post("controller/usuario.php?op=verificar",
        { 'user': user, 'contrasena': contrasena },
        function (data) {
            console.log(data)
            if (data != 'null') {
                $(location).attr("href", "index.php");
            } else {
                $("#error").html('Usuario y/o Contraseña incorrectos');
                setTimeout(function () {
                    $("#error").html('');
                }, 5000);
            }
        }
    );
});