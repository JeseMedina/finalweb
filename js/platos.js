var tabla;

function init(){
    mostrarForm(false);
    listar();

    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);  
    })
}

function limpiar()
{
    $("#idplato").val("");
    $("#nombre").val("");
    $("#precio").val("");
    $("#descripcion").val("");
    $("#imagen").val("");
}

function mostrarForm(flag)
{
    limpiar();
    if (flag)
    {
        $("#seccionListado").hide();
        $("#seccionFormulario").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnNuevo").hide();
    }
    else
    {
        $("#seccionListado").show();
        $("#seccionFormulario").hide();
        $("#btnNuevo").show();
    }
}

function cancelarForm()
{
    limpiar();
    mostrarForm(false);
}


const getPlatos = async () =>{
    const response = await fetch('../controller/plato.php?op=listar');
    return response.json();
}

function listar(){
    tabla=$('#platosTable').dataTable(
    {
        "aProcessing": true,
        "aServerSide": true,
        "dom": 'Bfrtip',
        "ajax":
                {
                    url: '../controller/plato.php?op=listar',
                    type : "get",
                    dataType : "json",                      
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]]
    }).DataTable();
}

function guardaryeditar(e)
{
    e.preventDefault();
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
 
    $.ajax({
        url: "../controller/plato.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
 
        success: function(datos){                    
            bootbox.alert(datos);           
            mostrarForm(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idplato){
    $.post("../controller/plato.php?op=mostrar",{idplato : idplato}, function(data, status){
        data = JSON.parse(data);        
        mostrarForm(true);

        $("#idplato").val(data.idplato);
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#precio").val(data.precio);
        $("#imagen").val(data.imagen);
    });
}

function activar(idplato){
    bootbox.confirm("¿Está Seguro de activar el Plato?", function(result){
        if(result)
        {
            $.post("../controller/plato.php?op=activar", {idplato : idplato}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            }); 
        }
    })
}

function desactivar(idplato)
{
    bootbox.confirm("¿Está seguro de desactivar el Plato", function(result){
        if(result)
        {
            $.post("../controller/plato.php?op=desactivar", {idplato : idplato}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            }); 
        }
    })
}

init();