<?php include '../templates/headerAdmin.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12"
            id="seccionListado">

            <div class="d-flex justify-content-between">
                <h3 class="">Usuarios</h3>
            </div>

            <div class="table-responsive-xl mt-3">
                <table class="table table-striped table-borderless align-middle"
                    id="usuariosTable">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Tipo</th>
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
            <h3>Usuario</h3>
            <div class="card col-md-12">
                <form action=""
                    class="p-4"
                    method="POST"
                    id="formulario">
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Usuario:</label>
                        <input type="hidden"
                            name="idusuario"
                            id="idusuario">
                        <input type="text"
                            class="form-control"
                            id="user"
                            name="user"
                            autofocus
                            required>
                    </div>
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Nombre:</label>
                        <input type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            autofocus
                            required>


                    </div>
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Celular:</label>
                        <input type="text"
                            id="celular"
                            class="form-control"
                            name="celular"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Direccion:</label>
                        <input type="text"
                            class="form-control"
                            id="direccion"
                            name="direccion"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Tipo:</label>
                        <input type="text"
                            class="form-control"
                            id="tipo"
                            name="tipo"
                            required>
                    </div>
                </form>
            </div>
            <h3 class="my-4">Favoritos</h3>
                <div class="col-md-12">
                    <div class="table-responsive-xl mt-3">
                        <table class="table table-striped table-borderless align-middle"
                            id="detalleTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
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

        </div>
    </div>
</div>


<?php include '../templates/footerAdmin.php' ?>
<script src="../js/usuarios.js"></script>