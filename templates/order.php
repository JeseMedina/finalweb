<section class="order" id="order">

    <h3 class="sub-heading"> Ordena ahora</h3>
    <h1 class="heading"> Facil y rapido</h1>

    <form action="controller/agregarPedidos.php" method="POST">
        <div class="inputBox">
            <div class="input">
                <span>Nombre</span>
                <input type="text" name="txtNombre" required>
            </div>
            <div class="input">
                <span>Numero de Celular</span>
                <input type="number" name="txtCelular" required>
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Direccion</span>
                <textarea name="txtDireccion" required></textarea>
            </div>
            <div class="input">
                <span>Orden</span>
                <textarea name="txtOrden" required></textarea>
            </div>
        </div>
        <input type="hidden" name="oculto" value="1">
        <input type="submit" value="Ordenar" class="btn">

    </form>

</section>