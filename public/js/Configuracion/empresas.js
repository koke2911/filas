var base_url = $("#txt_base_url").val();
var datatable_enabled = true;

function des_habilitar (a, b) {
  $("#btn_nuevo").prop("disabled", b);
  $("#btn_modificar").prop("disabled", a);
  $("#btn_subir_logo").prop("disabled", a);
  $("#btn_subir_certificado").prop("disabled", a);
  $("#btn_aceptar").prop("disabled", a);
  $("#btn_cancelar").prop("disabled", a);

  $("#txt_rut_EMPRE").prop("disabled", a);
  $("#txt_nombre_EMPRE").prop("disabled", a);
  $("#cmb_region").prop("disabled", a);
  $("#cmb_provincia").prop("disabled", a);
  $("#cmb_comuna").prop("disabled", a);
  $("#txt_resto_direccion").prop("disabled", a);
  $("#txt_fono").prop("disabled", a);
  
}

function mostrar_datos_empresa (data) {
  $("#txt_id_EMPRE").val(data["id_empresa"]);
  $("#txt_rut_EMPRE").val(data["rut_empresa"]);
  $("#txt_nombre_EMPRE").val(data["nombre_empresas"]);
  $("#cmb_region").val(data["id_region"]);
  $("#cmb_provincia").val(data["id_provincia"]);
  $("#cmb_comuna").val(data["id_comuna"]);
  $("#txt_resto_direccion").val(data["resto_direccion"]);
  $("#txt_fono").val(data["fono"]);
  $("#cmb_email").val(data['email']);
  $("#txt_website").val(data['website']);
  $("#cmb_comuna").val(data['id_comuna']);
  $("#cmb_calle").val(data['calle']);
  $("#cmb_numero").val(data['numero']);

  console.log(data);


  $.ajax({
    type: "GET",
    dataType: "json",
    url: base_url + '/Configuracion/Ctrl_empresas/get_data_empresa/' + data["id_empresa"],
  })
   .done(function (response) {
     
    
     $("#cmb_activity").val(response.activity);
    
   });
}

function llenar_cmb_region () {
  $.ajax({
    type: "GET",
    dataType: "json",
    url: base_url + "/Configuracion/Ctrl_usuarios/llenar_cmb_region",
  }).done(function (data) {
    $("#cmb_region").html('');

    opciones_region = "<option value=\"\">Seleccione una region</option>";

    for (var i = 0; i < data.length; i++) {
      opciones_region += "<option value=\"" + data[i].id + "\">" + data[i].region + "</option>";
    }

    $("#cmb_region").append(opciones_region);
  }).fail(function (error) {
    respuesta = JSON.parse(error["responseText"]);
    alerta.error("alerta", respuesta.message);
  });
}


function llenar_cmb_provincia () {
  var id_region = $("#cmb_region").val();

  $.ajax({
    type: "GET",
    dataType: "json",
    url: base_url + "/Configuracion/Ctrl_usuarios/llenar_cmb_provincia/" + id_region,
  }).done(function (data) {
    $("#cmb_provincia").html('');

    var opciones = "<option value=\"\">Seleccione una provincia</option>";

    for (var i = 0; i < data.length; i++) {
      opciones += "<option value=\"" + data[i].id + "\">" + data[i].provincia + "</option>";
    }

    $("#cmb_provincia").append(opciones);
  }).fail(function (error) {
    respuesta = JSON.parse(error["responseText"]);
    alerta.error("alerta", respuesta.message);
  });
}

function llenar_cmb_comuna () {
  var id_provincia = $("#cmb_provincia").val();

  $.ajax({
    type: "GET",
    dataType: "json",
    url: base_url + "/Configuracion/Ctrl_usuarios/llenar_cmb_comuna/" + id_provincia,
  }).done(function (data) {
    $("#cmb_comuna").html('');

    var opciones = "<option value=\"\">Seleccione una comuna</option>";

    for (var i = 0; i < data.length; i++) {
      opciones += "<option value=\"" + data[i].id + "\">" + data[i].comuna + "</option>";
    }

    $("#cmb_comuna").append(opciones);
  }).fail(function (error) {
    respuesta = JSON.parse(error["responseText"]);
    alerta.error("alerta", respuesta.message);
  });
}

function guardar_empre () {

  $.ajax({
    url: base_url + "/Configuracion/Ctrl_empresas/guardar_empre",
    type: "POST",
    async: false,
    data: {
      id_empresa: $("#txt_id_EMPRE").val(),
      rut_empresa: $("#txt_rut_EMPRE").val().split(".").join(""),
      nombre_empresas: $("#txt_nombre_EMPRE").val(),
      id_comuna: $("#cmb_comuna").val(),
      resto_direccion: $("#txt_resto_direccion").val(),
      fono: $("#txt_fono").val(),
      email: $("#cmb_email").val(),
      calle: $("#cmb_calle").val(),
      numero: $("#cmb_numero").val(),
      activity: $("#cmb_activity").val(),
      website: $("#txt_website").val()

    },
    success: function (respuesta) {
      const OK = 1;
      if (respuesta == OK) {
        $("#grid_empre").dataTable().fnReloadAjax(base_url + "/Configuracion/Ctrl_empresas/datatable_empresas");
        $("#form_EMPRE")[0].reset();
        des_habilitar(true, false);
        alerta.ok("alerta", "Empresa guardada con éxito");
        $("#datosEMPRE").collapse("hide");
        datatable_enabled = true;
      } else {
        alerta.error("alerta", respuesta);
      }
    },
    error: function (error) {
      respuesta = JSON.parse(error["responseText"]);
      alerta.error("alerta", respuesta.message);
    }
  });
}

function convertirMayusculas (texto) {
  var text = texto.toUpperCase().trim();
  return text;
}

var Fn = {
  // Valida el rut con su cadena completa "XXXXXXXX-X"
  validaRut: function (rutCompleto) {
    var rutCompleto_ = rutCompleto.replace(/\./g, "");

    if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto_))
      return false;
    var tmp = rutCompleto_.split('-');
    var digv = tmp[1];
    var rut = tmp[0];
    if (digv == 'K') digv = 'k';
    return (Fn.dv(rut) == digv);
  },
  dv: function (T) {
    var M = 0, S = 1;
    for (; T; T = Math.floor(T / 10))
      S = (S + T % 10 * (9 - M++ % 6)) % 11;
    return S ? S - 1 : 'k';
  },
  formatear: function (rut) {
    var tmp = this.quitar_formato(rut);
    var rut = tmp.substring(0, tmp.length - 1), f = "";
    while (rut.length > 3) {
      f = '.' + rut.substr(rut.length - 3) + f;
      rut = rut.substring(0, rut.length - 3);
    }
    return ($.trim(rut) == '') ? '' : rut + f + "-" + tmp.charAt(tmp.length - 1);
  },
  quitar_formato: function (rut) {
    rut = rut.split('-').join('').split('.').join('');
    return rut;
  }
}


$(document).ready(function () {
  $("#txt_id_EMPRE").prop("disabled", true);
  des_habilitar(true, false);
  llenar_cmb_region();
  llenar_cmb_provincia();
  llenar_cmb_comuna();

  $("#btn_nuevo").on("click", function () {
    des_habilitar(false, true);
    $("#form_EMPRE")[0].reset();

    $("#btn_modificar").prop("disabled", true);
    $("#btn_subir_logo").prop("disabled", true);
    $("#btn_subir_certificado").prop("disabled", true);
    $("#datosEMPRE").collapse("show");
  });

  $("#btn_modificar").on("click", function () {
    des_habilitar(false, true);
    $("#btn_modificar").prop("disabled", true);
    $("#btn_subir_logo").prop("disabled", true);
    $("#btn_subir_certificado").prop("disabled", true);
    datatable_enabled = false;
    $("#datosEMPRE").collapse("show");
  });

  $("#btn_aceptar").on("click", function () {
    if ($("#form_EMPRE").valid()) {
      guardar_empre();
    }
  });

  $("#btn_cancelar").on("click", function () {
    $("#form_EMPRE")[0].reset();
    des_habilitar(true, false);
    datatable_enabled = true;
    $("#datosEMPRE").collapse("hide");
  });

  $("#btn_subir_logo").on("click", function () {
    $("#divContenedorImportar").load(
     base_url + "/Configuracion/Ctrl_empresas/v_importar_logo"
    );

    $('#dlg_importar_logo').modal('show');
  });

  $("#btn_subir_certificado").on("click", function () {
    $("#divContenedorImportar2").load(
     base_url + "/Configuracion/Ctrl_empresas/v_importar_certificado"
    );

    $('#dlg_importar_certificado').modal('show');
  });

  $("#txt_rut_EMPRE").on("blur", function () {
    if (Fn.validaRut(Fn.formatear(this.value))) {
      $("#txt_rut_EMPRE").val(convertirMayusculas(Fn.formatear(this.value)));
    } else {
      alerta.error("alerta", "RUT incorrecto");
      $("#txt_rut_EMPRE").val("");
      setTimeout(function () {
        $("#txt_rut_EMPRE").focus();
      }, 100);
    }
  });

  $("#cmb_region").on("change", function () {
    llenar_cmb_provincia();
  });

  $("#cmb_provincia").on("change", function () {
    llenar_cmb_comuna();
  });

  $("#txt_nombre_EMPRE").on("blur", function () {
    this.value = convertirMayusculas(this.value);
  });

  $("#txt_resto_direccion").on("blur", function () {
    this.value = convertirMayusculas(this.value);
  });

  $.validator.addMethod("letras", function (value, element) {
    return this.optional(element) || /^[a-zA-ZñÑáÁéÉíÍóÓúÚ ]*$/.test(value);
  });

  $.validator.addMethod("charspecial", function (value, element) {
    return this.optional(element) || /^[^;\"'{}\[\]^<>=]+$/.test(value);
  });

  $.validator.addMethod("rut", function (value, element) {
    return this.optional(element) || /^[0-9-.Kk]*$/.test(value);
  });

  $.validator.addMethod("maxnumero", function (value, element) {
    if (value > 100) {
      return false;
    } else {
      return true;
    }
  })

  $("#form_EMPRE").validate({
    debug: true,
    errorClass: "my-error-class",
    highlight: function (element, required) {
      $(element).css('border', '2px solid #FDADAF');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).css('border', '1px solid #CCC');
    },
    rules: {
      txt_rut_EMPRE: {
        rut: true,
        required: true,
        maxlength: 12
      },
      txt_nombre_EMPRE: {
        required: true,
        letras: true,
        maxlength: 100
      },
    
      cmb_region: {
        required: true
      },
      cmb_provincia: {
        required: true
      },
      cmb_comuna: {
        required: true
      },
      txt_resto_direccion: {
        charspecial: true,
        maxlength: 200
      },
     
      txt_fono: {
        digits: true,
        maxlength: 11
      }
     

    },
    messages: {
      txt_rut_EMPRE: {
        rut: "Solo números o k",
        required: "El RUT de la Empresa es obligatorio",
        maxlength: "Máximo 10 caracteres"
      },
      txt_nombre_EMPRE: {
        required: "El nombre de la Empresa es obligatorio",
        letras: "Solo puede ingresar letras",
        maxlength: "Máximo 100 caracteres"
      },
     
      cmb_region: {
        required: "La región es obligatoria"
      },
      cmb_provincia: {
        required: "La provincia es obligatoria"
      },
      cmb_comuna: {
        required: "La comuna es obligatoria"
      },
      txt_resto_direccion: {
        charspecial: "Tiene caracteres no permitidos",
        maxlength: "Máximo 200 caracteres"
      },
     
      txt_fono: {
        digits: "Solo números",
        maxlength: "Máximo 11 números"
      },
      
    }
  });

  var grid_empre = $("#grid_empre").DataTable({
    responsive: true,
    paging: true,
    // scrollY: '50vh',
    // scrollCollapse: true,
    destroy: true,
    select: {
      toggleable: false
    },
    ajax: base_url + "/Configuracion/Ctrl_empresas/datatable_empresas",
    orderClasses: true,
    columns: [
      {"data": "id_empresa"},
      {"data": "rut_empresa"},
      {"data": "nombre_empresas"},
      {"data": "id_region"},
      {"data": "id_provincia"},
      {"data": "id_comuna"},
      {"data": "comuna"},
      {"data": "calle"},
      {"data": "numero"},
      {"data": "resto_direccion"},
      {"data": "usuario"},
      {"data": "fecha"},
      {
        "data": "id_empresa",
        "render": function (data, type, row) {
          return "<button type='button' class='traza_empre btn btn-warning' title='Traza Empresa'><i class='fas fa-shoe-prints'></i></button>";
        }
      },
      {"data": "fono"}
    ],
    "columnDefs": [
      {"targets": [0, 3, 4, 5,  7, 8,11,13], "visible": false, "searchable": false}
    ],
    language: {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "select": {
        "rows": "<br/>%d Perfiles Seleccionados"
      },
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Sig.",
        "previous": "Ant."
      }
    }
  });

  $("#grid_empre tbody").on("click", "tr", function () {
    if (datatable_enabled) {
      var tr = $(this).closest('tr');
      if ($(tr).hasClass('child')) {
        tr = $(tr).prev();
      }

      var data = grid_empre.row(tr).data();
      mostrar_datos_empresa(data);
      des_habilitar(true, false);
      $("#btn_modificar").prop("disabled", false);
      // $("#btn_subir_logo").prop("disabled", false);
      // $("#btn_subir_certificado").prop("disabled", false);
      $("#datosEMPRE").collapse("hide");
    }
  });

  $("#grid_empre tbody").on("click", "button.traza_empre", function () {
    if (datatable_enabled) {
      $("#divContenedorTraza").load(
       base_url + "/Configuracion/Ctrl_empresas/v_empresa_traza"
      );

      $('#dlg_traza_empresa').modal('show');
    }
  });
});