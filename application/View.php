<?php

class View
{
    private $_controlador;
    private $_js;
    private $_css;

    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();
        $this->_js = array();
        $this->_css = array();
    }

    public function Cedula($var) {
        $ced = (int) $var;
        if(is_int($ced) && $ced != 0):
            return $result = number_format($ced, 0, ",", ".");
        else:
            return $var;
        endif;
    }

    public function Telefono($var) {
        if ($var != '') {
            return '(' . substr($var, 0, 3) . ') ' . substr($var, 3, 3) . '-' . substr($var, 6);
        }
        return false;
    }

    public function Fecha($var, $time = false) {
        if ($time) {
            $date = new DateTime($var);
            return $date->format('d-m-Y h:i a');
        } else {
            $date = new DateTime($var);
            return $date->format('d-m-Y');
        }
    }

    public function Hora($var, $custom = false) {
        if ($custom) {
            $date = new DateTime($var);
            return $date->format($custom);
        } else {
            $date = new DateTime($var);
            return $date->format('h:i a');
        }
    }

    public function Dinero($var, $moneda = 'Bs.') {
        return number_format($var, 2, ",", ".") . ' ' . $moneda;
    }

    public function Decimal($var) {
        return number_format($var, 2, ",", ".");
    }

    public function Cantidad($var) {
        return number_format($var, 0, ",", ".");
    }

    public function CalculaEdad($fecha) {
        $fecha_actual = date ("Y-m-d"); 
        
        $array_nacimiento = explode("-", $fecha); 
        $array_actual = explode("-", $fecha_actual); 

        $anos =  $array_actual[0] - $array_nacimiento[0];
        $meses = $array_actual[1] - $array_nacimiento[1];
        $dias =  $array_actual[2] - $array_nacimiento[2];

        if ($dias < 0) { 
            --$meses; 
            switch ($array_actual[1]) { 
                case 1:         $dias_mes_anterior = 31; break; 
                case 2:         $dias_mes_anterior = 31; break; 
                case 3:
                    if (bisiesto($array_actual[0])) { 
                        $dias_mes_anterior=29; break; 
                    } else { 
                        $dias_mes_anterior = 28; break; 
                    } 
                case 4:         $dias_mes_anterior = 31; break; 
                case 5:         $dias_mes_anterior = 30; break; 
                case 6:         $dias_mes_anterior = 31; break; 
                case 7:         $dias_mes_anterior = 30; break; 
                case 8:         $dias_mes_anterior = 31; break; 
                case 9:         $dias_mes_anterior = 31; break; 
                case 10:       $dias_mes_anterior = 30; break; 
                case 11:       $dias_mes_anterior = 31; break; 
                case 12:       $dias_mes_anterior = 30; break; 
            }
            $dias = $dias + $dias_mes_anterior; 
        }

        if ($meses < 0) {
            --$anos; 
            $meses = $meses + 12; 
        }
        
        $resul_fecha = '';

        if ($anos !== 0) {
            $resul_fecha.= $anos . ' Años';
        }

        if ($anos === 0 && $meses !== 0) {
            $resul_fecha.= $meses . ' Meses ';
        }

        if ($anos === 0 && $dias !== 0) {
            $resul_fecha.= $dias . ' D&iacute;as';
        }

        return $resul_fecha;
    }

    protected function bisiesto($ao_actual) { 
        $bisiesto = false; 
        if (checkdate(2, 29, $ao_actual)) { 
            $bisiesto = true; 
        }
        return $bisiesto; 
    } 

    public function renderizar($vista, $item = FALSE, $item2 = FALSE) {
        $js = array();
        $css = array();

        if (count($this->_js)) {
            $js = $this->_js;
        }
        
        if (count($this->_css)) {
            $css = $this->_css;
        }

        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'js' => $js,
            'css' => $css,
            'item' => $item,
            'item2' => $item2
        );

        $_validationTitle = array(
            'cedula' => 'Debe indicar la nacionalidad con una V o E seguido de digitos, minimo 8 y maximo 9',
            'phone' => 'Debe introducir solo digitos, solo 10 digitos. Por ejemplo: 4141234567',
            'real' => 'Debe introducir solo digitos, minimo 4 y maximo 5',
            'realTwo' => 'Debe introducir solo digitos, minimo 1 y maximo 7',
            'text' => 'Debe introducir solo caracteres, minimo 3',
            'alphanum' => 'Debe introducir caracteres y digitos, minimo 3',
            'number' => 'Debe introducir solo digitos',
            'account_bank' => 'Debe introducir solo digitos, solo 20 digitos',
            'codigoSoc' => 'Debe introducir solo 10 digitos',
            'codigoNum' => 'Debe introducir dos digitos',
            'codigoAlphaNum' => 'Debe introducir un caracter mayuscula y un digito'
        );

        $_validationRegex = array(
            'cedula' => '[V|E]{1}\d{7,8}',
            'phone' => '\b\d{3}[-.]?\d{3}[-.]?\d{4}\b',
            'real' => '\b\d{5,6}([-.]\d{2})?\b',
            'realTwo' => '\b\d{1,7}([-.]\d{2})?\b',
            'text' => '\b[A-Za-z\s]{3,}\b',
            'alphanum' => '\b[A-Za-z0-9\s.,]{3,}\b',
            'number' => '\b[0-9]+\b',
            'account_bank' => '\b\d{20}\b',
            'codigoSoc' => '\b\d{10}\b',
            'codigoNum' => '\b\d{2}\b',
            'codigoAlphaNum' => '\b[A-Z]{1}\d{1}\b'
        );

        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.php';
        if (is_readable($rutaView)) {
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        } else {
            header('Location:' . BASE_URL . 'error/index/404/' . 'vista');
            return false;
        }
    }

    public function setJs(array $js) {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
            }
        } else {
            header('Location:' . BASE_URL . 'error/index/404/' . 'Javascript');
            return false;
        }
    }
    
    public function setCss(array $css) {
        if (is_array($css) && count($css)) {
            for ($i = 0; $i < count($css); $i++){
                $this->_css[] = BASE_URL . 'views/' . $this->_controlador . '/css/' . $css[$i] . '.css';
            }
        } else {
            header('Location:' . BASE_URL . 'error/index/404/' . 'CSS');
            return false;
        }
    }
}
