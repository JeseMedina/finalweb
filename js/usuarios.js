var tabla;

function init() {
    mostrarForm(false);
    listar();
}

function limpiar(){
    $("#idusuario").val("");
    $("#user").val("");
    $("#nombre").val("");
    $("#celular").val("");
    $("#direccion").val("");
    $("#tipo").val("");
}

function mostrarForm(flag){
    limpiar();
    if (flag)
    {
        $("#seccionListado").hide();
        $("#seccionFormulario").show();
    }
    else
    {
        $("#seccionListado").show();
        $("#seccionFormulario").hide();
    }
}

function cancelarForm(){
    limpiar();
    mostrarForm(false);
}

function listar() {
    tabla = $('#usuariosTable').dataTable(
        {
            "aProcessing": true,
            "aServerSide": true,
            "dom": 'Bfrtip',
            "ajax":
            {
                url: '../controller/usuario.php?op=listar',
                type: "get",
                dataType: "json",
                error: function (e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 10,
            "order": [[0, "desc"]]
        }).DataTable();
}

function mostrar(idusuario){
    $.post("../controller/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status){
        data = JSON.parse(data);        
        mostrarForm(true);

        $("#idusuario").val(data.idusuario);
        $("#user").val(data.user);
        $("#nombre").val(data.nombre);
        $("#celular").val(data.celular);
        $("#direccion").val(data.direccion);
        $("#tipo").val(data.tipo);
    });

    $.post("../controller/favorito.php?op=listarTodos&id="+idusuario,function(r){
        $("#detalleTable").html(r);
});
}

init();