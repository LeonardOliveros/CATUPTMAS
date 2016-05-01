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
          <label class="col-sm-3 col-sm-3 control-label">Plazo del Prestamo:</label>
          <div class="col-sm-9">
            <select name="plazo" class="form-control">
              <option value="">-- Seleccione --</option>
              <option>12</option>
              <option>24</option>
              <option>36</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo_prestamo" name="tipo_prestamo">
              <option value="">-- Seleccione --</option>
              <option>Normal</option>
              <option>Especial</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" id="estado" name="estado">
              <option value="">-- Seleccione --</option>
              <option>En Proceso</option>
              <option>Activo</option>
              <option>Rechazado</option>
              <option>Finalizado</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de Solicitud <small>(Fecha Exacta o Fecha Desde)</small>:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_solicitud_desde" name="fecha_solicitud_desde" placeholder="Introduzca la Fecha de Solicitud" value="<?php if (isset($this->datos["fecha_solicitud_desde"])): echo $this->datos["fecha_solicitud_desde"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de Solicitud <small>(Fecha Hasta)</small>:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_solicitud_hasta" name="fecha_solicitud_hasta" placeholder="Introduzca la Fecha de Solicitud" value="<?php if (isset($this->datos["fecha_solicitud_hasta"])): echo $this->datos["fecha_solicitud_hasta"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de Aprobaci&oacute;n <small>(Fecha Exacta o Fecha Desde)</small>:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_aprobacion_desde" name="fecha_aprobacion_desde" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_aprobacion_desde"])): echo $this->datos["fecha_aprobacion_desde"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de Aprobaci&oacute;n <small>(Fecha Hasta)</small>:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_aprobacion_hasta" name="fecha_aprobacion_hasta" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_aprobacion_hasta"])): echo $this->datos["fecha_aprobacion_hasta"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha del Primer Pago <small>(Fecha Exacta o Fecha Desde)</small>:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_primer_pago_desde" name="fecha_primer_pago_desde" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_primer_pago_desde"])): echo $this->datos["fecha_primer_pago_desde"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha del Primer Pago <small>(Fecha Hasta)</small>:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_primer_pago_hasta" name="fecha_primer_pago_hasta" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_primer_pago_hasta"])): echo $this->datos["fecha_primer_pago_hasta"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">¿Por Año?:</label>
          <div class="col-sm-9">
            <select class="form-control" id="ao" name="ao">
              <option>No</option>
              <option>Si</option>
            </select>
          </div>
        </div>
        <div id="div_ao_fecha" class="form-group hidden">
          <label class="col-sm-3 col-sm-3 control-label">Agrupar Por:</label>
          <div class="col-sm-9">
            <select class="form-control" name="ao_fecha">
              <option value="p.fecha_solicitud_pre">Fecha de Solicitud</option>
              <option value="p.fecha_aprobacion_pre">Fecha de Aprobacion</option>
              <option value="p.fecha_primer_pago_pre">Fecha del Primer Pago</option>
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
      <h3 class="text-center">Configuracion de las Estad&iacute;sticas <a href="<?= BASE_URL?>reporte/estadisticas" class="btn btn-info" style="float: right">Volver</a></h3>
      <br>
      <div class="col-md-3 col-md-offset-1">
        <dl>
          <dt>Plazo del Prestamo:</dt>
          <dd><?php if (isset($this->datos['plazo']) && $this->datos['plazo'] != ''): echo $this->datos['plazo']; else: echo 'General'; endif;?></dd>
          <dt>Tipo de Prestamo:</dt>
          <dd><?php if (isset($this->datos['tipo_prestamo']) && $this->datos['tipo_prestamo'] != ''): echo $this->datos['tipo_prestamo']; else: echo 'General'; endif;?></dd>
          <dt>Estado del Prestamo:</dt>
          <dd><?php if (isset($this->datos['estado']) && $this->datos['estado'] != ''): echo $this->datos['estado']; else: echo 'General'; endif;?></dd>
          <?php if (isset($this->datos['ao']) && $this->datos['ao'] != 'No'):?>
          <dt>¿Por Año?:</dt>
          <dd><?= $this->datos['ao'];?></dd>
          <?php endif;?>
        </dl>
      </div>
      <div class="col-md-3">
        <dl>
          <dt>Fecha de Solicitud <small>(Fecha Exacta o Fecha Desde)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_solicitud_desde']) && $this->datos['fecha_solicitud_desde'] != ''): echo $this->datos['fecha_solicitud_desde']; else: echo 'General'; endif;?></dd>
          <dt>Fecha de Solicitud <small>(Fecha Hasta)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_solicitud_hasta']) && $this->datos['fecha_solicitud_hasta'] != ''): echo $this->datos['fecha_solicitud_hasta']; else: echo 'General'; endif;?></dd>
          <dt>Fecha de Aprobaci&oacute;n <small>(Fecha Exacta o Fecha Desde)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_aprobacion_desde']) && $this->datos['fecha_aprobacion_desde'] != ''): echo $this->datos['fecha_aprobacion_desde']; else: echo 'General'; endif;?></dd>
          <dt>Fecha de Aprobaci&oacute;n <small>(Fecha Hasta)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_aprobacion_hasta']) && $this->datos['fecha_aprobacion_hasta'] != ''): echo $this->datos['fecha_aprobacion_hasta']; else: echo 'General'; endif;?></dd>
        </dl>
      </div>
      <div class="col-md-3">
        <dl>
          <dt>Fecha del Primer Pago <small>(Fecha Exacta o Fecha Desde)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_primer_pago_desde']) && $this->datos['fecha_primer_pago_desde'] != ''): echo $this->datos['fecha_primer_pago_desde']; else: echo 'General'; endif;?></dd>
          <dt>Fecha del Primer Pago <small>(Fecha Hasta)</small>:</dt>
          <dd><?php if (isset($this->datos['fecha_primer_pago_hasta']) && $this->datos['fecha_primer_pago_hasta'] != ''): echo $this->datos['fecha_primer_pago_hasta']; else: echo 'General'; endif;?></dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="row">
    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart']});
    </script>
    <?php if (isset($this->listadoAo) && $this->graficaAo == true):?>
    <div class="col-md-6">
      <div id="piechart_ao_ac"></div>
      <div id="chart_div_ao_ac"></div>
    </div>
    <!-- Abono Capital Año -->
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Año');
        data.addColumn('number', 'Number');
        var array = <?= json_encode($this->listadoAo)?>;
        var datos = [[]];
        for (i = 0; i < array.length; i++) {
          var monto = parseFloat(array[i].abono_capital);
          data.addRow([array[i].ao, monto]);
        }
        var options = {
          'width': 500,
          'height': 300,
          'title': 'Informacion de Abono a Capital Por Año'
        }
        var formatter = new google.visualization.NumberFormat({prefix: 'Bs. ', negativeColor: 'red', negativeParens: true});
        formatter.format(data, 1); // Apply formatter to second column
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_ao_ac'));
        google.visualization.events.addListener(chart, 'ready', function () {
          document.getElementById('chart_div_ao_ac').outerHTML = '<a class="btn btn-success" href="' + chart.getImageURI() + '" target="_blank">Generar Imagen</a>';
        });
        chart.draw(data, options);
      }
    </script>
    <div class="col-md-6">
      <div id="piechart_ao_count_prestamo"></div>
      <div id="chart_div_ao_count_prestamo"></div>
    </div>
    <!-- Cantidad Prestamo Año -->
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Año');
        data.addColumn('number', 'Number');
        var array = <?= json_encode($this->listadoAo)?>;
        var datos = [[]];
        for (i = 0; i < array.length; i++) {
          var monto = parseFloat(array[i].count_prestamo);
          data.addRow([array[i].ao, monto]);
        }
        var options = {
          'width': 500,
          'height': 300,
          'title': 'Informacion de Cantidad de Prestamos Por Año'
        }
        var formatter = new google.visualization.NumberFormat({fractionDigits: 0});
        formatter.format(data, 1); // Apply formatter to second column
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_ao_count_prestamo'));
        google.visualization.events.addListener(chart, 'ready', function () {
          document.getElementById('chart_div_ao_count_prestamo').outerHTML = '<a class="btn btn-success" href="' + chart.getImageURI() + '" target="_blank">Generar Imagen</a>';
        });
        chart.draw(data, options);
      }
    </script>
    <div class="col-md-6">
      <div id="piechart_abono"></div>
      <div id="chart_div_abono"></div>
    </div>
    <!-- Abonos -->
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Descripcion');
        data.addColumn('number', 'Number');
        var array = <?= json_encode($this->listadoGeneral)?>;
        var datos = [[]];
        var monto_capital = parseFloat(array.abono_capital);
        var monto_interes = parseFloat(array.abono_interes);
        data.addRow(['Abono Capital', monto_capital]);
        data.addRow(['Abono Interes(Ganancias)', monto_interes]);
        var options = {
          'width': 500,
          'height': 300,
          'title': 'Informacion de Abono a Capital Por Año'
        }
        var formatter = new google.visualization.NumberFormat({prefix: 'Bs. ', negativeColor: 'red', negativeParens: true});
        formatter.format(data, 1); // Apply formatter to second column
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_abono'));
        google.visualization.events.addListener(chart, 'ready', function () {
          document.getElementById('chart_div_abono').outerHTML = '<a class="btn btn-success" href="' + chart.getImageURI() + '" target="_blank">Generar Imagen</a>';
        });
        chart.draw(data, options);
      }
    </script>
    <div class="col-md-6">
      <div id="piechart_restante"></div>
      <div id="chart_div_restante"></div>
    </div>
    <!-- Prestado, Abono y Restante -->
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Descripcion');
        data.addColumn('number', 'Number');
        var array = <?= json_encode($this->listadoGeneral)?>;
        var datos = [[]];
        var monto_prestado = parseFloat(array.monto_pre);
        var monto_capital = parseFloat(array.abono_capital);
        var monto_restante = parseFloat(array.monto_restante);
        data.addRow(['Capital Prestado', monto_prestado]);
        data.addRow(['Abono Capital', monto_capital]);
        data.addRow(['Capital Restante(Deuda)', monto_restante]);
        var options = {
          'width': 500,
          'height': 300,
          'title': 'Informacion de Abono a Capital Por Año'
        }
        var formatter = new google.visualization.NumberFormat({prefix: 'Bs. ', negativeColor: 'red', negativeParens: true});
        formatter.format(data, 1); // Apply formatter to second column
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_restante'));
        google.visualization.events.addListener(chart, 'ready', function () {
          document.getElementById('chart_div_restante').outerHTML = '<a class="btn btn-success" href="' + chart.getImageURI() + '" target="_blank">Generar Imagen</a>';
        });
        chart.draw(data, options);
      }
    </script>
    <?php endif;?>
    <?php if (isset($this->graficaPlazo) && $this->graficaPlazo == true):?>
    <div class="col-md-6">
      <div id="piechart_plazo"></div>
      <div id="chart_div_plazo"></div>
    </div>
    <!-- Plazo -->
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Plazo');
        data.addColumn('number', 'Number');
        var array = <?= json_encode($this->listadoPlazo)?>;
        var datos = [[]];
        for (i = 0; i < array.length; i++) {
          var monto = parseInt(array[i].count);
          data.addRow([array[i].plazo_pre + ' Meses', monto]);
        }
        var options = {
          'width': 500,
          'height': 300,
          'title': 'Informacion Por Plazos'
        }
        var formatter = new google.visualization.NumberFormat({fractionDigits: 0});
        formatter.format(data, 1); // Apply formatter to second column
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_plazo'));
        google.visualization.events.addListener(chart, 'ready', function () {
          document.getElementById('chart_div_plazo').outerHTML = '<a class="btn btn-success" href="' + chart.getImageURI() + '" target="_blank">Generar Imagen</a>';
        });
        chart.draw(data, options);
      }
    </script>
    <?php endif;?>
    <?php if (isset($this->graficaTipo) && $this->graficaTipo == true):?>
    <div class="col-md-6">
      <div id="piechart_tipo"></div>
      <div id="chart_div_tipo"></div>
    </div>
    <!-- Tipo -->
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tipo');
        data.addColumn('number', 'Number');
        var array = <?= json_encode($this->listadoTipo)?>;
        var datos = [[]];
        for (i = 0; i < array.length; i++) {
          var monto = parseInt(array[i].count);
          data.addRow([array[i].tipo_prestamo_pre, monto]);
        }
        var options = {
          'width': 500,
          'height': 300,
          'title': 'Informacion Por Tipo'
        }
        var formatter = new google.visualization.NumberFormat({fractionDigits: 0});
        formatter.format(data, 1); // Apply formatter to second column
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_tipo'));
        google.visualization.events.addListener(chart, 'ready', function () {
          document.getElementById('chart_div_tipo').outerHTML = '<a class="btn btn-success" href="' + chart.getImageURI() + '" target="_blank">Generar Imagen</a>';
        });
        chart.draw(data, options);
      }
    </script>
    <?php endif;?>
  </div>
  <?php endif;?>
</div>