<?php include '../templates/headerAdmin.php' ?>

<?php
if (!isset($_GET['codigo'])) {
    header('Location: platos.php?mensaje=error');
    exit();
}

include_once '../config/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from platos where codigo = ?;");
$sentencia->execute([$codigo]);
$platos = $sentencia->fetch(PDO::FETCH_OBJ);
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar Platos:
                </div>
                <form action="../controller/editarProceso.php" class="p-4" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="txtNombre" required value="<?php echo $platos->nombre; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Precio:</label>
                        <input type="text" class="form-control" name="txtPrecio" required value="<?php echo $platos->precio; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Imagen:</label>
                        <input type="text" class="form-control" name="txtImagen" required value="<?php echo $platos->imagen ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $platos->codigo; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../templates/footerAdmin.php' ?>