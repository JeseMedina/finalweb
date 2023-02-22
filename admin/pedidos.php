<?php include '../templates/headerAdmin.php'; ?>
<?php

session_start();

if ($_SESSION['tipo'] != 'admin') {
    header("Location: ../index.php");
} else {
?>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-12"
      id="seccionListado">
      <div class="d-flex justify-content-between">
        <h3 class="">Pedidos</h3>
      </div>
      <div class="table-responsive-xl mt-3">
        <table class="table table-striped table-borderless align-middle"
          id="pedidosTable">
          <thead>
            <tr>
              <th scope="col">Usuario</th>
              <th scope="col">Direccion</th>
              <th scope="col">Celular</th>
              <th scope="col">Fecha</th>
              <th scope="col">Hora</th>
              <th scope="col">Total</th>
              <th scope="col">Estado</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-12"
      id="seccionFormulario">
      <h3>Pedido</h3>
      <form action=""
        class="p-4"
        method="POST"
        id="formulario">
        <div class="mb-3">
          <label for=""
            class="form-label">Fecha:</label>
          <input type="hidden"
            name="idpedido"
            id="idpedido">
          <input type="date"
            class="form-control"
            name="fecha"
            id="fecha"
            readonly>
        </div>
        <div class="mb-3">
          <label for=""
            class="form-label">Hora:</label>
          <input type="time"
            class="form-control"
            name="hora"
            id="hora"
            readonly>
        </div>
        <div class="d-grid mb-3">
          <label for=""
            class="form-label">Cliente:</label>
          <input type="text"
            id="cliente"
            class="form-control"
            readonly>
        </div>
        <div class="mb-3">
          <label for=""
            class="form-label">Direccion:</label>
          <input type="text"
            class="form-control"
            name="direccion"
            id="direccion"
            readonly>
        </div>
        <div class="mb-3">
          <label for=""
            class="form-label">Celular:</label>
          <input type="text"
            class="form-control"
            name="celular"
            id="celular"
            readonly>
        </div>

        <h5>Pedido</h5>
        <div class="table-responsive-xl mt-3">
          <table class="table table-striped table-borderless align-middle"
            id="detalles">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Imagen</th>
                <th scope="col">Cantidad</th>
                <th scope="col">SubTotal</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th>TOTAL</th>
                <th></th>
                <th></th>
                <th></th>
                <th>
                  <h4 id="total">$ 0.00</h4>
                  <input type="hidden"
                    name="total_pedido"
                    id="total_pedido">
                </th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="d-grid">
          <button data-toggle="tooltip"
            data-placement="bottom"
            title="Volver Atrás"
            class="btn btn-danger mt-2"
            onclick="cancelarForm()"
            type="button">
            Volver Atras
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
<?php include '../templates/footerAdmin.php' ?>
<?php
}
?>
<script src="../js/pedidos.js"></script>