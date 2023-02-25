<section class="order"
  id="order">

  <h3 class="sub-heading"> Ordena ahora</h3>
  <h1 class="heading"> Facil y rapido</h1>

  <form id="formulario"
    name="formulario"
    method="POST">
    <div class="inputBox">
      <div class="input">
        <span>Nombre</span>
        <input type="hidden"
          name="idusuario"
          value="<?php echo $_SESSION['idusuario'] ?>">
        <input type="hidden"
          name="fecha"
          id="fecha"
          value="">
        <input type="hidden"
          name="hora"
          id="hora"
          value="">
        <input type="text"
          name="txtNombre"
          value="<?php  echo $_SESSION['nombre']  ?>"
          required
          readonly>
      </div>
      <div class="input">
        <span>Numero de Celular</span>
        <input type="number"
          name="txtCelular"
          value="<?php  echo $_SESSION['celular']  ?>"
          required
          readonly>
      </div>
    </div>
    <div class="inputBox">
      <div class="input">
        <span>Direccion</span>
        <input type="text"
          name="txtDireccion"
          value="<?php  echo $_SESSION['direccion']  ?>"
          required
          readonly>
      </div>
      <div class="input">
        <span>Seleccionar</span>
        <select name="selectOrden"
          onchange="selectPlato()"
          id="selectOrden">
          <option selected="true"
            disabled="disabled">Seleccione un Plato</option>
        </select>
      </div>
    </div>
    <table id="detalles"
      class="">
      <thead>
        <th>Opciones</th>
        <th>Plato</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
      </thead>
      <tfoot>
        <th></th>
        <th></th>
        <th></th>
        <th>TOTAL</th>
        <th>
          <h4 id="total">$ 0.00</h4><input type="hidden"
            name="total_orden"
            id="total_orden">
        </th>
      </tfoot>
      <tbody>

      </tbody>
    </table>

    <input type="hidden"
      name="oculto"
      value="1">
    <input type="submit"
      value="Ordenar"
      class="btn"
      id="btnOrdenar">

  </form>

</section>