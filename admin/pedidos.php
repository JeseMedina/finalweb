<?php include '../templates/headerAdmin.php'; ?>
<?php
    include_once "../model/conexion.php"; 
    $sentencia = $bd -> query("select * from pedidos");
    $pedidos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">

                <!-- alerta -->
                <?php
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                ?>
                <div class="alert alert-danger alert dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        <strong>Error!</strong> Vuelve a intentar.
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
                        <strong>Entregado!</strong> El pedido fue entrgado.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>

                <!-- fin alerta -->

                <div class="card">
                    <div class="card-header">
                        Lista de Pedidos
                    </div>
                    <div class="p-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Orden</th>
                                    <th class="text-center" scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($pedidos as $dato){
                                ?>

                                <tr>
                                    <td scope="row"><?php echo $dato->codigo;?></td>
                                    <td><?php echo $dato->nombre;?></td>
                                    <td><?php echo $dato->celular;?></td>
                                    <td><?php echo $dato->direccion;?></td>
                                    <td><?php echo $dato->orden;?></td>
                                    <td class="text-center"><a onclick="return confirm('¿El pedido fue entregado?')" class="text-warning" href="eliminarPeidos.php?codigo=<?php echo $dato->codigo;?>"><i class="bi bi-truck" alt="asd"></i></a></td>
                                </tr>

                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include '../templates/footerAdmin.php' ?>