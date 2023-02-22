$("#frmAcceso").on('submit', function (e) {
  e.preventDefault();
  let formData = new FormData($("#frmAcceso")[0]);

  let contrasena = $("#contrasena").val();
  let contrasena2 = $("#contrasena2").val();

  if (contrasena === contrasena2) {
    $.ajax({
      url: "controller/usuario.php?op=guardaryeditar",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (datos) {
        bootbox.alert(datos);
      }
    });
  } else {
    $("#error").html('Las contraseñas no coinciden');
    setTimeout(function () {
      $("#error").html('');
    }, 5000);
  }
});