<!--body wrapper start-->
<div class="wrapper">
  <?php if (!$this->resultado):?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
          <div class="col-sm-9">
            <input type="text" autofocus class="form-control" id="cedula" name="cedula" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["cedula"])): echo $this->datos["cedula"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Forma de Pago:</label>
          <div class="col-sm-9">
            <select name="forma" class="form-control">
              <option value="">-- General --</option>
              <option>Deposito</option>
              <option>Cheque</option>
              <option>Transferencia</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha <small>(Fecha Exacta o Fecha Desde):</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" placeholder="Introduzca la Fecha (AAAA/MM/DD)" value="<?php if (isset($this->datos["fecha_desde"])): echo $this->datos["fecha_desde"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha <small>(Fecha Hasta):</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" placeholder="Introduzca la Fecha (AAAA/MM/DD)" value="<?php if (isset($this->datos["fecha_hasta"])): echo $this->datos["fecha_hasta"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Banco:</label>
          <div class="col-sm-9">
            <select name="banco" class="form-control">
              <option value="">-- General --</option>
              <?php foreach ($this->bancos AS $banco):?>
              <option value="<?= $banco['id_ban']?>"><?= $banco['nombre_ban']?> - <?= $banco['numero_cuenta_ban']?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Movimiento:</label>
          <div class="col-sm-9">
            <select class="form-control" id="estado" name="estado">
              <option value="">-- General --</option>
              <option>En Proceso</option>
              <option>Rechazado</option>
              <option>Aceptado</option>
            </select>
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Generar</button>
          <a href="<?= BASE_URL?>index" class="btn btn-info">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
  <?php else:?>
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">Configuracion de las Estad&iacute;sticas <a href="<?= BASE_URL?>reporte/capital" class="btn btn-info" style="float: right">Volver</a></h3>
      <br>
      <div class="col-md-6">
        <dl>
          <dt>C&eacute;dula:</dt>
          <dd><?php if (isset($this->datos['cedula']) && $this->datos['cedula'] != ''): echo $this->datos['cedula']; else: echo 'General'; endif;?></dd>
          <dt>Forma de Pago:</dt>
          <dd><?php if (isset($this->datos['forma']) && $this->datos['forma'] != ''): echo $this->datos['forma']; else: echo 'General'; endif;?></dd>
          <dt>Fecha <small>(Fecha Exacta o Fecha Desde)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_desde']) && $this->datos['fecha_desde'] != ''): echo $this->datos['fecha_desde']; else: echo 'General'; endif;?></dd>
          <dt>Fecha <small>(Fecha Hasta)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_hasta']) && $this->datos['fecha_hasta'] != ''): echo $this->datos['fecha_hasta']; else: echo 'General'; endif;?></dd>
          <dt>Banco:</dt>
          <dd><?php if (isset($this->datos['banco']) && $this->datos['banco'] != ''): echo $this->datos['banco']; else: echo 'General'; endif;?></dd>
          <dt>Estado del Movimiento:</dt>
          <dd><?php if (isset($this->datos['estado']) && $this->datos['estado'] != ''): echo $this->datos['estado']; else: echo 'General'; endif;?></dd>
        </dl>
      </div>
      <div class="col-md-6">
        <div id="piechart_tipo"></div>
        <div id="chart_div_tipo"></div>
      </div>
    </div>
  </div>
<?php endif;?>
</div>

<script type="text/javascript">
  google.charts.load('current', {packages: ['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Tipo');
    data.addColumn('number', 'Number');
    var array_tipo = <?= json_encode($this->listadoTipo)?>;
    var datos_tipo = [[]];
    for (i = 0; i < array_tipo.length; i++) {
      var monto = parseFloat(array_tipo[i].monto);
      data.addRow([array_tipo[i].tipo_mov, monto]);
    }
    var options = {
      'is3D': true,
      'width': 500,
      'height': 300,
      'title': 'Informe de Movimientos'
    }
    var formatter = new google.visualization.NumberFormat({prefix: 'Bs. ', negativeColor: 'red', negativeParens: true});
    formatter.format(data, 1); // Apply formatter to second column
    // Instantiate and draw the chart.
    var chart = new google.visualization.PieChart(document.getElementById('piechart_tipo'));
    google.visualization.events.addListener(chart, 'ready', function () {
      document.getElementById('chart_div_tipo').outerHTML = '<a class="btn btn-success" href="' + chart.getImageURI() + '" target="_blank">Generar Imagen</a>';
    });
    chart.draw(data, options);
  }
</script>