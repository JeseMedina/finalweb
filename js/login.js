$("#frmAcceso").on('submit',function(e){

    e.preventDefault();
    user = $("#user").val();
    contrasena = $("#contrasena").val();

    $.post("../controller/usuario.php?op=verificar",
    {"user":user,"contrasena":contrasena},
    function(data){
        if(data != "null"){
            $(location).attr("href", "index.php");
        }else{
            console.log("Usuario y/o Contraseña incorrectos");
        }
    });
});