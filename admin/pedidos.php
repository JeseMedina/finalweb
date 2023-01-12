<?php include '../templates/headerAdmin.php'; ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12"
            id="seccionListado">
            <div class="d-flex justify-content-between">
                <h3 class="">Pedidos</h3>
                <button class="btn btn-success"
                    id="btnNuevo"
                    onclick="mostrarForm(true)">Nuevo</button>
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
            <div class="card">
                <form action=""
                    class="p-4"
                    method="POST"
                    id="formulario">
                    <div class="d-grid">
                        <label for=""
                            class="form-label">Fecha:</label>
                        <input type="hidden"
                            name="idpedido"
                            id="idpedido">
                        <input type="date"
                            class="form-control"
                            name="fecha"
                            id="fecha"
                            required="">
                    </div>
                    <div class="d-grid">
                        <label for=""
                            class="form-label">Hora:</label>
                        <input type="time"
                            class="form-control"
                            name="hora"
                            id="hora"
                            required="">
                    </div>
                    <div class="d-grid">
                        <label for=""
                            class="form-label">Cliente:</label>
                        <select id="idcliente"
                            name="idcliente"
                            class="form-control selectpicker"
                            data-live-search="true"
                            required>
                        </select>
                    </div>
                    <div class="d-grid">
                        <label for=""
                            class="form-label">Direccion:</label>
                        <input type="text"
                            class="form-control"
                            name="direccion"
                            id="direccion"
                            required=""
                            readonly>

                    </div>
                    <div class="d-grid">
                        <label for=""
                            class="form-label">Celular:</label>
                        <input type="text"
                            class="form-control"
                            name="celular"
                            id="celular"
                            required=""
                            readonly>

                    </div>


                    <div class="table-responsive-xl mt-3">
                        <table class="table table-striped table-borderless align-middle"
                            id="detalleTable">
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
                                            name="total_pedido "
                                            id="total_pedido">
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="d-grid">
                        <button data-toggle="tooltip"
                            data-placement="bottom"
                            title="Guardar Plato"
                            class="btn btn-primary"
                            type="submit"
                            id="btnGuardar">Guardar
                        </button>
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
</div>
<?php include '../templates/footerAdmin.php' ?>
<script src="../js/pedidos.js"></script>