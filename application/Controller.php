<?php

abstract class Controller
{
    private $_registry; 
    protected $_view;
    protected $_acl;
    protected $_request;

    public function __construct() {
        $this->_registry = Registry::getInstancia();
        $this->_acl = $this->_registry->_acl;
        $this->_request = $this->_registry->_request;
        $this->_view = new View(new Request);
    }

    abstract public function index();

    protected function loadModel ($modelo) {
        $modelo = $modelo . 'Model';
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';

        if (is_readable($rutaModelo)) {
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        } else {
            header('Location:' . BASE_URL . 'error/index/404/' . 'modelo');
            return false;
        }
    }

    protected function getLibrary ($libreria) {
        $rutaLibreria = ROOT . 'libs' . DS . $libreria . '.php';

        if (is_readable($rutaLibreria)) {
            require_once $rutaLibreria;
        } else {
            header('Location:' . BASE_URL . 'error/index/404/' . 'libreria');
            return false;
        }
    }

    protected function getTexto($valor) {
        if (isset($_POST[$valor]) && !empty($_POST[$valor])) {
            $_POST[$valor] = htmlspecialchars($_POST[$valor], ENT_QUOTES);
            return $_POST[$valor];
        } else {
            return '';
        }
    }

    protected function getInt($valor) {
        if (isset($_POST[$valor]) && !empty($_POST[$valor])) {
            $_POST[$valor] = filter_input(INPUT_POST, $valor, FILTER_VALIDATE_INT);
            return $_POST[$valor];
        } else {
            return 0;
        }
    }

    protected function getFloat($valor) {
        if (isset($_POST[$valor]) && !empty($_POST[$valor])) {
            $_POST[$valor] = filter_input(INPUT_POST, $valor, FILTER_VALIDATE_FLOAT);
            return $_POST[$valor];
        } else {
            return 0;
        }
    }

    protected function record_sort($records, $field, $reverse=false) {
        $hash = array();
        
        foreach ($records as $key => $record) {
            $hash[$record[$field].$key] = $record;
        }
        
        ($reverse)? krsort($hash) : ksort($hash);
        
        $records = array();
        
        foreach ($hash as $record) {
            $records []= $record;
        }
        
        return $records;
    }

    protected function redireccionar($ruta = FALSE) {
        if ($ruta) {
            header ('Location:' . BASE_URL . $ruta);
            exit;
        } else {
            header ('Location:' . BASE_URL . 'index');
            exit;
        }
    }

    protected function redireccionar2($ruta = FALSE, $tiempo) {
        if ($ruta) {
            $url = BASE_URL . $ruta;
        } else {
            $url = BASE_URL . 'index';
        }
        header ('refresh: ' . $tiempo . ';' . $url);
        exit;
    }

    protected function filtrarInt($valor) {
        $valor = (int) $valor;
        if (is_int($valor)) {
            return $valor;
        } else {
            return 0;
        }
    }

    protected function getPostParam($valor) {
        if (isset($_POST[$valor])) {
            return $_POST[$valor];
        }
    }

    protected function getSql($clave) {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = strip_tags($_POST[$clave]);

            if (!get_magic_quotes_gpc()) {
                $_POST[$clave] = mysqli_real_escape_string(mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME), $_POST[$clave]);
            }

            return trim($_POST[$clave]);
        }
    }

    protected function getAlphaNum($clave) {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
    }

    public function validarEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        }
        return TRUE;
    }

    public function validarFecha($fecha, $mayor = true) {
        $fecha1 = strtotime($fecha);
        $fecha_actual = strtotime(date('Y-m-d'));
        if (!$fecha) {
            if ($mayor) {
                if ($fecha1 > $fecha_actual) {
                    return true;
                }
            } else {
                if ($fecha1 < $fecha_actual) {
                    return true;
                }
            }
        }
        return false;
    }
}
