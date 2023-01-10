var tabla;

function init() {
    mostrarForm(false);
    listar();
}

function limpiar(){
    $("#idpedido").val("");
    $("#fecha").val("");
    $("#hora").val("");
    $("#total").val("");
    $("#total_pedido").val("");
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
    tabla = $('#pedidosTable').dataTable(
        {
            "aProcessing": true,
            "aServerSide": true,
            "dom": 'Bfrtip',
            "ajax":
            {
                url: '../controller/pedido.php?op=listar',
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

function mostrar(idpedido){
    $.post("../controller/pedido.php?op=mostrar",{idpedido : idpedido}, function(data, status){
        data = JSON.parse(data);        
        mostrarForm(true);

        $("#idpedido").val(data.idpedido);
        $("#fecha").val(data.fecha);
        $("#hora").val(data.hora);
    });

    $.post("../controller/pedido.php?op=listarDetalle&id="+idpedido,function(r){
        $("#detalleTable").html(r);
});
}

function cancelar(idpedido) {
    bootbox.confirm("¿Está Seguro de cancelar el Pedido?", function (result) {
        if (result) {
            $.post("../controller/pedido.php?op=cancelar", { idpedido: idpedido }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function cocinar(idpedido) {
    bootbox.confirm("¿Está Seguro de comenzar a cocinar el Pedido?", function (result) {
        if (result) {
            $.post("../controller/pedido.php?op=cocinar", { idpedido: idpedido }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function llevar(idpedido) {
    bootbox.confirm("¿Está Seguro de llevar el Pedido al cliente?", function (result) {
        if (result) {
            $.post("../controller/pedido.php?op=llevar", { idpedido: idpedido }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function entregar(idpedido) {
    bootbox.confirm("¿El cliente recibio su Pedido?", function (result) {
        if (result) {
            $.post("../controller/pedido.php?op=entregado", { idpedido: idpedido }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();