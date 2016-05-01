<?php

class errorController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index($codigo = false, $texto = false) {
        $this->_view->titulo = 'Error';
        $this->_view->mensaje = $this->_getError($codigo, $texto);
        $this->_view->renderizar('index');
    }
    
    public function access($codigo) {
        $this->_view->titulo = 'Error de Acceso';
        $this->_view->mensaje = $this->_getError($codigo);
        $this->_view->renderizar('access');
    }

    private function _getError($codigo = false, $texto = false) {
        
        if ($codigo) {
            $codigo = $this->filtrarInt($codigo);
            if (is_int($codigo)) {
                $codigo = $codigo;
            }
        } else {
            $codigo = 'default';
        }
        
        $error['default'] = 'Ha ocurrido un error y la pagina no puede mostrarse';
        $error['5050'] = 'Acceso restringido';
        $error['8080'] = 'Tiempo de sesion agotado!';
        $error['404'] = 'No se encontro';
        
        if (array_key_exists($codigo, $error)) {
            if ($texto) {
                return $error[$codigo] . ' ' . $texto;
            } else {
                return $error[$codigo];
            }
        } else {
            return $error['default'];
        }
    }
}
