$(document).ready(function () {
  $('#dynamic-table').dataTable({
    "aaSorting": [[ 0, "asc" ]]
  });

  $("#btn_otorgamiento").on('click', function () {
    $("#id_prestamo").val($(this).data('id'));
  });

  $("#btn_cancelacion").on('click', function () {
    $("#id_prestamo").val($(this).data('id'));
    $("#monto").val($(this).data('capital'));
    $("#capital_amortizar").val($(this).data('capital'));
    $("#interes_amortizar").val($(this).data('interes'));
  });

  $("#btn_abono").on('click', function () {
    $("#id_prestamo").val($(this).data('id'));
    $("#monto").val($(this).data('capital'));
    $("#capital_amortizar").val($(this).data('capital'));
    $("#interes_amortizar").val($(this).data('interes'));
  });

  $("#estado_otorgamiento").on('change', function () {
    if ($("#estado_otorgamiento").val() == 'Activo') {
      $("#div_fecha_otorgamiento").removeClass('hidden');
    } else {
      $("#div_fecha_otorgamiento").addClass('hidden');
    }
  });

  $("#formCambiarEstado").on('submit', function (e) {
    if ($("#estado_otorgamiento").val() == '') {
      alert('Debe Seleccionar el Estado del Prestamo');
      e.preventDefault();
      return 0;
    }

    if ($("#codigo_pre").val() == '') {
      alert('Debe Introducir el Codigo del Prestamo');
      e.preventDefault();
      return 0;
    }

    if ($("#fecha_aprobacion_pre").val() == '') {
      alert('Debe Introducir la Fecha de Aprobacion');
      e.preventDefault();
      return 0;
    }

    if ($("#fecha_primer_pago_pre").val() == '') {
      alert('Debe Introducir la Fecha del Primer Pago');
      e.preventDefault();
      return 0;
    }

    return;
  });

  $("#formCancelacion").on('submit', function (e) {
    if ($("#fecha_cancelacion").val() == '') {
      alert('Debe Introducir la Fecha de Cancelacion');
      e.preventDefault();
      return 0;
    }

    if ($("#capital_amortizar").val() == '' || parseFloat($("#capital_amortizar").val()) == 0) {
      alert('Debe Introducir el Capital a Amortizar');
      e.preventDefault();
      return 0;
    }

    if ($("#capital_amortizar").val() < $("#monto").val()) {
      alert('El Abono a Capital es menor a la Deuda del Prestamo...');
      e.preventDefault();
      return 0;
    }

    if ($("#capital_amortizar").val() > $("#monto").val()) {
      alert('El Abono a Capital es mayor a la Deuda del Prestamo...');
      e.preventDefault();
      return 0;
    }

    if ($("#interes_amortizar").val() == '' || parseFloat($("#interes_amortizar").val()) == 0) {
      alert('Debe Introducir el Interes a Amortizar');
      e.preventDefault();
      return 0;
    }

    return;
  });

  $("#formAbono").on('submit', function (e) {
    if ($("#fecha_abono").val() == '') {
      alert('Debe Introducir la Fecha del Abono');
      e.preventDefault();
      return 0;
    }

    if ($("#capital_amortizar").val() == '' || parseFloat($("#capital_amortizar").val()) == 0) {
      alert('Debe Introducir el Capital a Amortizar');
      e.preventDefault();
      return 0;
    }

    if ($("#capital_amortizar").val() > $("#monto").val()) {
      alert('El Abono a Capital es mayor a la Deuda del Prestamo...');
      e.preventDefault();
      return 0;
    }

    if ($("#interes_amortizar").val() == '' || parseFloat($("#interes_amortizar").val()) == 0) {
      alert('Debe Introducir el Interes a Amortizar');
      e.preventDefault();
      return 0;
    }

    return;
  });
});