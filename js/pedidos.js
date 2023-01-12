let tabla;

let date = new Date();
let hora = `${date.toLocaleTimeString().split(":", 3)[0]}:${date.toLocaleTimeString().split(":", 3)[1]}`;

const mes = () =>{
    if(date.getMonth()>=9){
        return date.getMonth();
    } else {
        return `${date.getMonth()}`;
    }
}
let fecha = `${date.getFullYear()}-${mes()+1}-${date.getDate()}`;



function init() {
    mostrarForm(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    $.post("../controller/usuario.php?op=selectClientes", function (r) {
        $("#idcliente").html(r);
        $('#idcliente').selectpicker('refresh');
    });
}

function limpiar() {
    $("#idpedido").val("");
    $("#fecha").val(fecha);
    $("#hora").val(hora);
    $("#idcliente").val("");
    $("#direccion").val("");
    $("#celular").val("");
    $("#total").val("");
    $("#total_pedido").val("");
    detalles=0;
}

function mostrarForm(flag) {
    limpiar();
    if (flag) {
        $("#seccionListado").hide();
        $("#seccionFormulario").show();
        $("#btnGuardar").prop("disabled", false);
        $("#listadoPlatos").show();
        listarPlatos();
    }
    else {
        $("#seccionListado").show();
        $("#seccionFormulario").hide();
    }
}

function cancelarForm() {
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

function mostrar(idpedido) {
    $.post("../controller/pedido.php?op=mostrar", { idpedido: idpedido }, function (data, status) {
        data = JSON.parse(data);
        mostrarForm(true);
        $("#listadoPlatos").hide();

        $("#idpedido").val(data.idpedido);
        $("#fecha").val(data.fecha);
        $("#hora").val(data.hora);
        $("#idcliente").selectpicker('refresh');
        $("#idcliente").val(data.idusuario);
        $("#direccion").val(data.direccion);
        $("#celular").val(data.celular);

        $("#btnGuardar").prop("disabled", true);
    });

    $.post("../controller/pedido.php?op=listarDetalle&id=" + idpedido, function (r) {
        $("#detalleTable").html(r);
    });
}

function listarPlatos(){
    tabla=$('#platosTable').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [                
                     
                ],
        "ajax":
                {
                    url: '../controller/plato.php?op=listarPlatosActivos',
                    type : "get",
                    dataType : "json",                      
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[ 0, "desc" ]]
    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    let formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controller/pedido.php?op=guardaryeditar",
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

let cont = 0;
let detalles=0;
function agregarDetalle(idPlato, plato, precio) {
    let cantidad = 1;

    if (idPlato != "") {
        let subtotal = cantidad * precio;
        let fila = '<tr class="filas" id="fila' + cont + '">' +
            '<td><button data-toggle="tooltip" data-placement="right" title="Eliminar Detalle" type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button></td>' +
            '<td><input type="hidden" name="idPlato[]" value="' + idPlato + '">' + plato + '</td>' +
            '<td><input type="number" name="cantidad[]" step=".10" id="cantidad[]" onchange="modificarSubototales()" onkeyup="modificarSubototales()" value="' + cantidad + '"></td>' +
            '<td><input type="number" name="precio[]" value="' + precio + '"></td>' +
            '<td><span name="subtotal" id="subtotal' + cont + '">' + subtotal + '</span></td>' +
            '</tr>';
        cont++;
        detalles = detalles + 1;
        $('#detalles').append(fila);
        modificarSubototales();
    }
    else {
        alert("Error al ingresar el detalle, revisar los datos del plato");
    }
}

function modificarSubototales() {
    var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i < cant.length; i++) {
        var inpC = cant[i];
        var inpP = prec[i];
        var inpS = sub[i];

        inpS.value = inpC.value * inpP.value;
        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();

}

function calcularTotales() {
    var sub = document.getElementsByName("subtotal");
    var total = 0.0;

    for (var i = 0; i < sub.length; i++) {
        total += document.getElementsByName("subtotal")[i].value;
    }
    $("#total").html("$ " + total);
    $("#total_pedido").val(total);
    evaluar();
}

function evaluar() {
    if (detalles > 0) {
        $("#btnGuardar").prop("disabled", false);
    }
    else {
        $("#btnGuardar").prop("disabled", true);
        cont = 0;
    }
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

function eliminarDetalle(indice){
    $("#fila" + indice).remove();
    calcularTotales();
    detalles=detalles-1;
    evaluar()
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
