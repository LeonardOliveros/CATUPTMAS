<?php

class loginController extends Controller
{

    private $_modelo;
    
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('login');
    }
    
    public function index(){
        if (Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_view->titulo = 'Iniciar Sesion';
        if ($this->getInt('enviar') == 1) {
            $this->_view->datos = $_POST;
            if (!$this->getAlphaNum('usuario')) {
                $this->_view->_error ='<strong>¡Error!</strong> Debe Introducir su nombre de Usuario';
                $this->_view->renderizar('index','login');
                exit;
            }
            if (!$this->getSql('pass')) {
                $this->_view->_error = '<strong>¡Error!</strong> Debe Introducir su Password';
                $this->_view->renderizar('index','login');
                exit;
            }
            $row = $this->_modelo->getUsuario(
                    $this->getAlphaNum('usuario'),
                    $this->getSql('pass')
                    );
            if (!$row) {
                $this->_view->_error = '<strong>¡Cuidado!</strong> Usuario y/o password Incorrectos';
                $this->_view->renderizar('index','login');
                exit;
            }
            if ($row['estado'] != 1) {
                $this->_view->_error = '<strong>¡Cuidado!</strong> Este usuario no esta Habilitado';
                $this->_view->renderizar('index','login');
                exit;
            }
            Session::set('autenticado', true);
            Session::set('level', $row['rol']);
            Session::set('usuario', $row['usuario']);
            Session::set('nombre', $row['nombre']);
            Session::set('id_usuario', $row['id_usuario']);
            Session::set('tiempo', 60);
            echo "<script>alert('Bienvinido " . $row['nombre'] . " a " . APP_NAME . "')</script>";
            $this->redireccionar2('index', 0.1);
        }
        $this->_view->renderizar('index','login');
    }
    
    public function cerrar(){
        Session::destroy();
        $this->redireccionar();
    }
}
