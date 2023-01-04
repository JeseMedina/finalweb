<?php include '../templates/headerAdmin.php'; ?>
<?php
    include_once "../config/conexion.php";
    $sentencia = $bd -> query("select * from platos");
    $platos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <!-- alerta -->
                <?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
                ?>
                <div class="alert alert-warning alert dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        <strong>Error!</strong>Rellena todos los campos.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>

                <?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
                ?>
                <div class="alert alert-success alert dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        <strong>Registrado!</strong>Los datos se registraron correctamente.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>

                <?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                ?>
                <div class="alert alert-danger alert dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        <strong>Error!</strong>Vuelve a intentar.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>
                
                <?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
                ?>
                <div class="alert alert-success alert dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        <strong>Editado!</strong>Los datos fueron actualizados.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>

                <?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
                ?>
                <div class="alert alert-warning alert dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        <strong>Eliminado!</strong>Los datos fueron borrados.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>

                <!-- fin alerta -->
                <div class="card">
                    <div class="card-header">
                        Lista de Platos
                    </div>
                    <div class="p-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($platos as $dato){
                                ?>

                                <tr>
                                    <td scope="row"><?php echo $dato->codigo;?></td>
                                    <td><?php echo $dato->nombre;?></td>
                                    <td>$<?php echo $dato->precio;?></td>
                                    <td><img src="<?php echo $dato->imagen ?>" width="60px" height="40px"></td>
                                    <td><a class="text-success" href="editarPlato.php?codigo=<?php echo $dato->codigo;?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?')" class="text-danger" href="../controller/eliminar.php?codigo=<?php echo $dato->codigo;?>"><i class="bi bi-trash"></i></a></td>
                                </tr>

                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ingresar Datos:
                    </div>
                    <form action="../controller/registrar.php" class="p-4" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="txtNombre" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Precio:</label>
                            <input type="text" class="form-control" name="txtPrecio" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Imagen:</label>
                            <input type="text" class="form-control" name="txtImagen" placeholder="Ingrese URL de imagen" autofocus required>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="oculto" value="1">
                            <input type="submit" class="btn btn-primary" value="Registrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include '../templates/footerAdmin.php' ?>