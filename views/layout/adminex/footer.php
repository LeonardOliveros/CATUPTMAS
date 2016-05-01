<!--footer section start-->
  <!-- <footer>
    2014 © AdminEx by ThemeBucket
  </footer> -->
  <!--footer section end-->
  <?php if (Session::get('autenticado')):?>
  </div>
  <?php endif;?>
  <!-- main content end-->
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?= $_layoutParams['ruta_js']?>jquery-1.10.2.min.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>jquery-migrate-1.2.1.min.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>bootstrap.min.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>modernizr.min.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>jquery.nicescroll.js"></script>
<!--easy pie chart-->
<script src="<?= $_layoutParams['ruta_js']?>easypiechart/jquery.easypiechart.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>easypiechart/easypiechart-init.js"></script>
<!--Sparkline Chart-->
<script src="<?= $_layoutParams['ruta_js']?>sparkline/jquery.sparkline.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>sparkline/sparkline-init.js"></script>
<!--icheck -->
<script src="<?= $_layoutParams['ruta_js']?>iCheck/jquery.icheck.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>icheck-init.js"></script>
<!-- jQuery Flot Chart-->
<script src="<?= $_layoutParams['ruta_js']?>flot-chart/jquery.flot.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>flot-chart/jquery.flot.tooltip.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>flot-chart/jquery.flot.resize.js"></script>
<!--Morris Chart-->
<script src="<?= $_layoutParams['ruta_js']?>morris-chart/morris.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>morris-chart/raphael-min.js"></script>
<!--Calendar-->
<script src="<?= $_layoutParams['ruta_js']?>calendar/clndr.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>calendar/evnt.calendar.init.js"></script>
<script src="<?= $_layoutParams['ruta_js']?>calendar/moment-2.2.1.js"></script>
<!--DataTable-->
<script type="text/javascript" language="javascript" src="<?= $_layoutParams['ruta_js']?>advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?= $_layoutParams['ruta_js']?>data-tables/DT_bootstrap.js"></script>
<!--Growl-->
<script type="text/javascript" src="<?= $_layoutParams['ruta_js']?>bootstrap-notify.min.js"></script>
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>-->
<!--common scripts for all pages-->
<script src="<?= $_layoutParams['ruta_js']?>scripts.js"></script>
<script type="text/javascript" src="<?= $_layoutParams['ruta_js']?>bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<!--Dashboard Charts-->
<!--<script src="<?= $_layoutParams['ruta_js']?>dashboard-chart-init.js"></script>-->
<?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])):?>
  <?php for($i = 0; $i < count($_layoutParams['js']); $i++):?>
    <script src="<?= $_layoutParams['js'][$i];?>" type="text/javascript"></script>
  <?php endfor;?>
<?php endif;?>
</body>
</html>