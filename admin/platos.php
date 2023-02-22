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
        <h3 class="">Platos</h3>
        <button class="btn btn-success"
          id="btnNuevo"
          onclick="mostrarForm(true)">Nuevo</button>
      </div>

      <div class="table-responsive-xl mt-3">
        <table class="table table-striped table-borderless align-middle"
          id="platosTable">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">descripcion</th>
              <th scope="col">Precio</th>
              <th scope="col">Imagen</th>
              <th scope="col">Estado</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-6"
      id="seccionFormulario">
      <h3>Plato</h3>
      <div class="card">
        <form action=""
          class="p-4"
          method="POST"
          id="formulario">
          <div class="mb-3">
            <label for=""
              class="form-label">Nombre:</label>
            <input type="hidden"
              name="idplato"
              id="idplato">
            <input type="text"
              class="form-control"
              id="nombre"
              name="nombre"
              autofocus
              required>
          </div>
          <div class="mb-3">
            <label for=""
              class="form-label">Descripcion:</label>

            <textarea class="form-control"
              id="descripcion"
              name="descripcion"></textarea>

          </div>
          <div class="mb-3">
            <label for=""
              class="form-label">Precio:</label>
            <input type="number"
              id="precio"
              class="form-control"
              name="precio"
              required>
          </div>
          <div class="mb-3">
            <label for=""
              class="form-label">Imagen:</label>
            <input type="text"
              class="form-control"
              id="imagen"
              name="imagen"
              placeholder="Ingrese URL de imagen"
              required>
          </div>
          <div class="mb-3">
            <button data-toggle="tooltip"
              data-placement="bottom"
              title="Guardar Plato"
              class="btn btn-primary"
              type="submit"
              id="btnGuardar">Guardar
            </button>
            <button data-toggle="tooltip"
              data-placement="bottom"
              title="Cancelar y Volver Atrás"
              class="btn btn-danger mt-2"
              onclick="cancelarForm()"
              type="button">
              Cancelar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/footerAdmin.php' ?>
<?php
}
?>
<script src="../js/platos.js"></script>