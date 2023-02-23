let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

const getPlatosActivos = async () => {
  const response = await fetch('controller/plato.php?op=listarActivos');
  return response.json();
}

const listar = async () => {
  const menuList = document.querySelector('#menuList');
  const platos = await getPlatosActivos();
  platos.results.forEach(plato => {
    menuList.innerHTML += `
      <div class="box">
        <div class="image">
          <img loading=lazy src="${plato.imagen}" alt="${plato.nombre}">
        </div>
        <div class="content">
          <h3>${plato.nombre}</h3>
          <span class="price">$ ${plato.precio}</span>
        </div>
      </div>
    `;
  });
}

const listarSelect = async () => {
  const selectMenu = document.querySelector('#selectOrden');
  const platos = await getPlatosActivos();
  platos.results.forEach(plato => {
    const option = document.createElement('option');
    option.value = JSON.stringify(plato);
    option.textContent = plato.nombre;
    selectMenu.appendChild(option);
  });
}

function selectPlato() {
  let selectBox = document.getElementById("selectOrden");
  let selectedValue = selectBox.options[selectBox.selectedIndex].value;
  let plato = JSON.parse(selectedValue);
  agregarDetalle(plato.idplato, plato.nombre, plato.precio);
}

let cont = 0;
let detalles = 0;
function agregarDetalle(idplato, plato, precio) {
  let cantidad = 1;

  if (idplato != "") {
    let subtotal = cantidad * precio;
    let fila = '<tr class="filas" id="fila' + cont + '">' +
      '<td><button data-toggle="tooltip" data-placement="right" title="Eliminar Detalle" type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button></td>' +
      '<td><input type="hidden" name="idplato[]"value="' + idplato + '">' + plato + '</td>' +
      '<td><input type="number" name="cantidad[]" min="1" onchange="modificarSubototales()" onkeyup="modificarSubototales()" id="cantidad[]" value="' + cantidad + '"></td>' +
      '<td><input type="text" name="precio[]" id="precio[]" value="' + precio + '" readonly></td>' +
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
  let cant = document.getElementsByName("cantidad[]");
  let prec = document.getElementsByName("precio[]");
  let sub = document.getElementsByName("subtotal");

  for (let i = 0; i < cant.length; i++) {
    let inpC = cant[i];
    let inpP = prec[i];
    let inpS = sub[i];
    let total = inpC.value * inpP.value

    inpS.value = parseFloat(total);
    document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
  }
  calcularTotales();

}

function calcularTotales() {

  let sub = document.getElementsByName("subtotal");
  let total = 0.0;

  for (let i = 0; i < sub.length; i++) {
    total += document.getElementsByName("subtotal")[i].value;
  }
  $("#total").html("$ " + total);
  $("#total_orden").val(total);
  evaluar();
}

function evaluar() {
  if (detalles > 0) {
    $("#btnOrdenar").show();
  }
  else {
    $("#btnOrdenar").hide();
    cont = 0;
  }
}

function eliminarDetalle(indice) {
  $("#fila" + indice).remove();
  calcularTotales();
  detalles = detalles - 1;
  evaluar();
}


listar();
listarSelect();
evaluar();