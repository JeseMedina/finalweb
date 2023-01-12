let tabla;

function init() {
    mostrarForm(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
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
        $("#favoritos").hide();
        $("#btnGuardar").prop("disabled", false);
        $("#btnNuevo").hide();
    }
    else
    {
        $("#seccionListado").show();
        $("#seccionFormulario").hide();
        $("#btnNuevo").show();
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
        $("#favoritos").show();
        $("#btnGuardar").prop("disabled", true);

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

function guardaryeditar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    let formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarForm(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

init();