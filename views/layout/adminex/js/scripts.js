(function() {
    "use strict";

    // custom scrollbar
    $("html").niceScroll({styler:"fb",cursorcolor:"#65cea7", cursorwidth: '6', cursorborderradius: '0px', background: '#424f63', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});
    $(".left-side").niceScroll({styler:"fb",cursorcolor:"#65cea7", cursorwidth: '3', cursorborderradius: '0px', background: '#424f63', spacebarenabled:false, cursorborder: '0'});
    $(".left-side").getNiceScroll();

    if ($('body').hasClass('left-side-collapsed')) {
        $(".left-side").getNiceScroll().hide();
    }

    // Toggle Left Menu
   jQuery('.menu-list > a').click(function() {
      var parent = jQuery(this).parent();
      var sub = parent.find('> ul');
      
      if(!jQuery('body').hasClass('left-side-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
               parent.removeClass('nav-active');
               jQuery('.main-content').css({height: ''});
               mainContentHeightAdjust();
            });
         } else {
            visibleSubMenuClose();
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
                mainContentHeightAdjust();
            });
         }
      }
      return false;
   });

   function visibleSubMenuClose() {
      jQuery('.menu-list').each(function() {
         var t = jQuery(this);
         if(t.hasClass('nav-active')) {
            t.find('> ul').slideUp(200, function(){
               t.removeClass('nav-active');
            });
         }
      });
   }

   function mainContentHeightAdjust() {
      // Adjust main content height
      var docHeight = jQuery(document).height();
      if(docHeight > jQuery('.main-content').height())
         jQuery('.main-content').height(docHeight);
   }

   //  class add mouse hover
   jQuery('.custom-nav > li').hover(function(){
      jQuery(this).addClass('nav-hover');
   }, function(){
      jQuery(this).removeClass('nav-hover');
   });

   // Menu Toggle
   jQuery('.toggle-btn').click(function(){
       $(".left-side").getNiceScroll().hide();
       
       if ($('body').hasClass('left-side-collapsed')) {
           $(".left-side").getNiceScroll().hide();
       }
      var body = jQuery('body');
      var bodyposition = body.css('position');

      if(bodyposition != 'relative') {

         if(!body.hasClass('left-side-collapsed')) {
            body.addClass('left-side-collapsed');
            jQuery('.custom-nav ul').attr('style','');

            jQuery(this).addClass('menu-collapsed');

         } else {
            body.removeClass('left-side-collapsed chat-view');
            jQuery('.custom-nav li.active ul').css({display: 'block'});

            jQuery(this).removeClass('menu-collapsed');

         }
      } else {

         if(body.hasClass('left-side-show'))
            body.removeClass('left-side-show');
         else
            body.addClass('left-side-show');

         mainContentHeightAdjust();
      }

   });
   
   searchform_reposition();

   jQuery(window).resize(function(){

      if(jQuery('body').css('position') == 'relative') {

         jQuery('body').removeClass('left-side-collapsed');

      } else {

         jQuery('body').css({left: '', marginRight: ''});
      }

      searchform_reposition();

   });

   function searchform_reposition() {
      if(jQuery('.searchform').css('position') == 'relative') {
         jQuery('.searchform').insertBefore('.left-side-inner .logged-user');
      } else {
         jQuery('.searchform').insertBefore('.menu-right');
      }
   }

    // panel collapsible
    $('.panel .tools .fa').click(function () {
        var el = $(this).parents(".panel").children(".panel-body");
        if ($(this).hasClass("fa-chevron-down")) {
            $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200); }
    });

    $('.todo-check label').click(function () {
        $(this).parents('li').children('.todo-title').toggleClass('line-through');
    });

    $(document).on('click', '.todo-remove', function () {
        $(this).closest("li").remove();
        return false;
    });

    $("#sortable-todo").sortable();


    // panel close
    $('.panel .tools .fa-times').click(function () {
        $(this).parents(".panel").parent().remove();
    });

    // tool tips

    $('.tooltips').tooltip();

    // popovers

    $('.popovers').popover();

    //Sistema Actualizar Pagos
    $("#enfoque").on('change', function () {
      if ($("#enfoque").val() == 'Por Departamento') {
        $("#opcion").removeClass('hidden');
        $("#departamento").removeClass('hidden');
        $("#individual").addClass('hidden');
      } else if ($("#enfoque").val() == 'Individual') {
        $("#opcion").removeClass('hidden');
        $("#departamento").addClass('hidden');
        $("#individual").removeClass('hidden');
      } else {
        $("#opcion").addClass('hidden');
        $("#departamento").addClass('hidden');
        $("#individual").addClass('hidden');
      }
    });

    $("#tipo_mov").on('change', function() {

        $("#abono_capital").on('keyup', function() {
            if ($("#abono_capital").val() > 0) {
                $("#total").val(0);
                $("#total").val(parseFloat($("#abono_capital").val()) + parseFloat($("#abono_interes").val()));
            }
        });

        $("#abono_interes").on('keyup', function() {
            if ($("#abono_interes").val() > 0) {
                $("#total").val(0);
                $("#total").val(parseFloat($("#abono_capital").val()) + parseFloat($("#abono_interes").val()));
            }
        });

        if ($("#tipo_mov").val() == 'Pago Prestamo') {
            $("#prestamos").html('');
            $.post(_root_ + 'prestamo/getPrestamos','cedula=' + $("#socio_mov").val(), function(data){
                if (data) {
                    $("#prestamos").append('<option value="">-- Seleccione --</option>');
                    $.each(data, function(key) {
                        $("#prestamos").append('<option value="' + data[key].id_pre+ '">' + parseFloat(data[key].monto_pre) + ' Bs. - ' + data[key].fecha_solicitud_pre + '</option>');
                        $("#div_prestamos").append('<input type="hidden" id="prestamo_' + data[key].id_pre + '" value="' + data[key].monto_pre+ '" />');
                    });
                    $("#monto").addClass('hidden');
                    $("#monto_prestamo").removeClass('hidden');
                    $("#div_prestamos").removeClass('hidden');
                    return 0;
                }
                $("#prestamos").append('<option value="">-- Seleccione --</option>');
                $("#monto").removeClass('hidden');
                $("#monto_prestamo").addClass('hidden');
                $("#div_prestamos").addClass('hidden');
                alert('Sin Deuda de Prestamos');
                return 0;
            }, 'json');
        } else {
            $("#prestamos").val('');
            $("#div_prestamos").addClass('hidden');
        }
    });


    var getCuotas = function(){
            $.post(_root_ + 'prestamo/getCuotasPrestamo', 'prestamo=' + $("#prestamos").val(), function(data) {
                console.log(data);
                $("#cuotas_prestamos").html('');
                for (var i = 0; i < data.length; i++) {
                    $("#cuotas_prestamos").append('<option value="' + data[i].id_cuo_pre + '">N.C.: ' + data[i].numero_cuo_pre + ' Fecha: ' + data[i].fecha_cuo_pre + ' Monto: ' + data[i].cuota_cuo_pre + '</option>');
                }
                if (i > 0){
                    $("#div_cuotas_prestamos").removeClass('hidden');
                } else {
                    $("#div_cuotas_prestamos").addClass('hidden');
                }
                $("#cuotas_prestamos").append('<option value="todas">Todas</option>');
                $("#cuotas_prestamos").append('<option selected value="">-- Seleccione --</option>');
            }, 'json');
        };

    $("#prestamos").on('change', function() {
        if ($("#prestamos").val() != '') {
            getCuotas();
            $("#info_prestamo").html('');
            $("#info_prestamo").append('<h3><span class="label label-primary">Informacion del Prestamo</span></h3>');
            $("#info_prestamo").append('<h3><span class="label label-primary">Pagos</span></h3>');
            $.post(_root_ + 'prestamo/getPagos','prestamo=' + $("#prestamos").val(), function(data){
                if (data) {
                    total_pago = 0;
                    total_porcentaje = 0;
                    $.each(data, function(key) {
                        total_pago = parseFloat(total_pago) + parseFloat(data[key].monto_total_pag_pre);
                        $("#info_prestamo").append('<p><strong>Fecha del Pago:</strong> ' + data[key].fecha_pag_pre + ' - <strong>Monto:</strong> ' + data[key].monto_total_pag_pre + ' Bs.</p>');
                    });
                    total_porcentaje = total_pago * 100;
                    total_porcentaje = total_porcentaje / $("#prestamo_" + $("#prestamos").val()).val();
                    $("#info_prestamo").append('<p><strong>Total Pagado:</strong> ' + total_pago + ' Bs. / ' + total_porcentaje + ' %  </p>');                    
                    if (total_porcentaje >= 80) {
                        $("#info_prestamo").append('<p class="text-info"><strong>Este socio puede optar por otro prestamo</strong></p>');
                    }
                    return 0;
                }
                //$("#div_cuotas_prestamos").addClass('hidden');
                $("#info_prestamo").append('<p>No Hay Pagos Registrados</p>');
            }, 'json');
        }
    });

    $("#monto_mov").on('keyup', function() {
        if (parseFloat($("#monto_mov").val()) > parseFloat($("#ihad").val()) && $("#tipo_mov").val() != 'Pago Prestamo' && $("#tipo_mov").val() != 'Deposito - Voluntario') {
            $("#label_disponible").removeClass('label-primary');
            $("#label_disponible").addClass('label-danger');
            $("#total_disponible").addClass('text-danger');
            $("#aceptar").attr('disabled', true);
        } else {
            $("#label_disponible").removeClass('label-danger');
            $("#label_disponible").addClass('label-primary');
            $("#total_disponible").removeClass('text-danger');
            $("#aceptar").attr('disabled', false);
        }
    });

    $("#socio_mov").on('focusout', function() {
        if ($("#socio_mov").val() == '') {
            $("#socio_mov").focus();
            return 0;
        }
        $.post(_root_ + 'movimiento/getSocio','cedula=' + $("#socio_mov").val(),function(data){
            if (data) {
                $("#ahorros").removeClass('hidden');
                $("#socio").html(data.socio);
                $("#ahorros_patrono").html(data.ahorro_patrono);
                $("#ahorros_socio").html(data.ahorro_socio);
                $("#ahorros_voluntario").html(data.ahorro_voluntario);
                $("#total_ahorros").html(data.total_ahorros);
                $("#retiros_patrono").html(data.retiro_patrono);
                $("#retiros_socio").html(data.retiro_socio);
                $("#retiros_voluntario").html(data.retiro_voluntario);
                $("#total_retiros").html(data.total_retiros);
                $("#total_haberes").html(data.total_haberes);
                $("#total_disponible").html(data.total_disponible);
                $("#ahorros").append('<input type="hidden" id="ihad" value="' + parseFloat(data.total_disponible) + '" />');
                $("#aceptar").attr('disabled', false);
                return 0;
            }
            $("#aceptar").attr('disabled', true);
            $("#socio").html('</br>');
            $("#ahorros_patrono").html('0,00 Bs.');
            $("#ahorros_socio").html('0,00 Bs.');
            $("#ahorros_voluntario").html('0,00 Bs.');
            $("#total").html('0,00 Bs.');
            $("#total_disponible").html('0,00 Bs.');
            $("#ahorros").addClass('hidden');
            alert('Socio no encontrado...');
            $("#socio_mov").focus();
        }, 'json');
    });

    $("#ao").on('change', function() {
      if ($("#ao").val() == 'Si') {
        $("#div_ao_fecha").removeClass('hidden');
      } else {
        $("#div_ao_fecha").addClass('hidden');
      }
    });

    $("#sueldo_soc").on('keyup', function() {
      if ($("#sueldo_soc").val() != '') {
          $("#aporte_patrono_soc").val($("#sueldo_soc").val() * 0.10);
          $("#aporte_socio_soc").val($("#sueldo_soc").val() * 0.10);
      } else {
          $("#aporte_patrono_soc").val('0.00');
          $("#aporte_socio_soc").val('0.00');
      }
    });

})(jQuery);