<?php include '../templates/headerAdmin.php'; ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12"
            id="seccionListado">

            <div class="d-flex justify-content-end">
                <button class="btn btn-success">Nuevo</button>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-responsive align-middle"
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
            id="seccionNuevo">
            <h3>Nuevo Plato</h3>
            <div class="card">
                <form action="../controller/registrar.php"
                    class="p-4"
                    method="POST"
                    id="formulario">
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Nombre:</label>
                        <input type="text"
                            class="form-control"
                            name="txtNombre"
                            autofocus
                            required>
                    </div>
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Descripcion:</label>

                            <textarea class="form-control"
                                id="floatingTextarea" name="txtDescripcion"></textarea>

                    </div>
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Precio:</label>
                        <input type="number"
                            class="form-control"
                            name="txtPrecio"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for=""
                            class="form-label">Imagen:</label>
                        <input type="text"
                            class="form-control"
                            name="txtImagen"
                            placeholder="Ingrese URL de imagen"
                            required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden"
                            name="oculto"
                            value="1">
                        <input type="submit"
                            class="btn btn-primary"
                            value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include '../templates/footerAdmin.php' ?>













<?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
                    ?>
<div class="alert alert-warning alert dismissible fade show d-flex justify-content-between align-items-center"
    role="alert">
    <div>
        <strong>Error!</strong>Rellena todos los campos.
    </div>
    <button type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php 
                        }
                    ?>

<?php
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
                    ?>
<div class="alert alert-success alert dismissible fade show d-flex justify-content-between align-items-center"
    role="alert">
    <div>
        <strong>Registrado!</strong>Los datos se registraron correctamente.
    </div>
    <button type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php 
                        }
                    ?>

<?php
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                    ?>
<div class="alert alert-danger alert dismissible fade show d-flex justify-content-between align-items-center"
    role="alert">
    <div>
        <strong>Error!</strong>Vuelve a intentar.
    </div>
    <button type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php 
                        }
                    ?>

<?php
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
                    ?>
<div class="alert alert-success alert dismissible fade show d-flex justify-content-between align-items-center"
    role="alert">
    <div>
        <strong>Editado!</strong>Los datos fueron actualizados.
    </div>
    <button type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php 
                        }
                    ?>

<?php
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
                    ?>
<div class="alert alert-warning alert dismissible fade show d-flex justify-content-between align-items-center"
    role="alert">
    <div>
        <strong>Eliminado!</strong>Los datos fueron borrados.
    </div>
    <button type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php 
                        }
                ?>