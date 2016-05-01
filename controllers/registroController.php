<?php

class registroController extends Controller
{
    private $_registro;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_registro = $this->loadModel('registro');
    }
    
    public function lista() {
        $this->_view->datos = $this->_registro->getUsuarios();
        $this->_view->titulo = 'Listar Usuarios';
        $this->_view->setJs(array('dynamic_table_usuario'));
        $this->_view->renderizar('lista', 'perfil', 'listar_usuarios');
    }
    
    public function index() {
        $this->_view->titulo = 'Registro Usuario';
        $this->_view->roles = $this->_registro->getRoles();
        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getSql('nombre')) {
                $this->_view->_error = 'Debe Introducir su Nombre';
                $this->_view->renderizar('index', 'perfil', 'registrar');
                exit;
            }

            if (!$this->getAlphaNum('usuario')) {
                $this->_view->_error = 'Debe Introducir su Nombre de Usuario';
                $this->_view->renderizar('index', 'perfil', 'registrar');
                exit;
            }

            if ($this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) {
                $this->_view->_error = 'El Usuario ' . $this->getAlphaNum('usuario') . ' ya Existe';
                $this->_view->renderizar('index', 'perfil', 'registrar');
                exit;
            }

            if ($this->getTexto('rol') == '') {
                $this->_view->_error = 'Debe Seleccionar un Rol';
                $this->_view->renderizar('index', 'perfil', 'registrar');
                exit;
            }

            if (!$this->getSql('pass')) {
                $this->_view->_error = 'Debe Introducir su Password';
                $this->_view->renderizar('index', 'perfil', 'registrar');
                exit;
            }

            if ($this->getPostParam('pass') != $this->getPostParam('confirmar')) {
                $this->_view->_error = 'Los Passwords no Coinciden';
                $this->_view->renderizar('index', 'perfil', 'registrar');
                exit;
            }

            $this->_registro->registrarUsuario(
                    $this->getAlphaNum('usuario'),
                    $this->getSql('nombre'),
                    $this->getSql('pass'),
                    $this->getInt('rol')
                    );
            $this->_view->datos = false;
            echo "<script>alert('Registro satisfactoriamente...')</script>";
            $this->redireccionar2('registro/lista', 0.1);
        }        
        $this->_view->renderizar('index', 'perfil', 'registrar');
    }
    
    public function modificar($id) {
        $this->_view->titulo = 'Editar Usuario';

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('registro/lista');
        }

        if ($this->_registro->getUsuario($id)){
            $this->_view->datos = $this->_registro->getUsuario($this->filtrarInt($id));
        } else {
            $this->redireccionar('registro/lista');
        }

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('usuario')) {
                $this->_view->_error = 'Debe Introducir el Usuario';
                $this->_view->renderizar('modificar', 'perfil', 'modificar');
                exit;
            }

            if (!$this->getTexto('nombre')) {
                $this->_view->_error = 'Debe Introducir el Nombre';
                $this->_view->renderizar('modificar', 'perfil', 'modificar');
                exit;
            }

            $this->_registro->editarUsuario(
                    $id,
                    $this->getPostParam('nombre')
                    );
            echo "<script>alert('Actualizado satisfactoriamente...')</script>";
            $this->redireccionar2('registro/lista', 0.1);
        }        
        $this->_view->renderizar('modificar', 'perfil', 'modificar');
    }
    
    public function rol($id) {
        $this->_view->titulo = 'Cambiar Rol';

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('registro/lista');
        }

        if ($this->_registro->getUsuario($id)){
            $this->_view->datos = $this->_registro->getUsuario($id);
            $this->_view->roles = $this->_registro->getRoles();
        } else {
            $this->redireccionar('registro/lista');
        }

        if ($this->getInt('guardar') == 1) {
            $this->_registro->cambiarRol(
                    $id,
                    $this->getPostParam('role')
                    );
            echo "<script>alert('Rol cambiado satisfactoriamente...')</script>";
            $this->redireccionar2('registro/lista', 0.1);
        }
        $this->_view->renderizar('rol', 'perfil', 'usuarios');
    }
    
    public function clave($id) {
        $this->_view->titulo = 'Cambiar Clave';
        
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('registro/lista');
        }

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            if (!$this->getTexto('pass')) {
                $this->_view->_error = 'Debe Introducir la Clave Actual';
                $this->_view->renderizar('clave', 'perfil', 'clave');
                exit;
            }

            $row = $this->_registro->getUsuario($this->filtrarInt($id));
            
            if (Hash::getHash('sha1', $this->getTexto('pass'), HASH_KEY) != $row['pass']) {
                $this->_view->_error = 'La Contraseña Actual es Incorrecta';
                $this->_view->renderizar('clave', 'perfil', 'clave');
                exit;
            } else {
                if (!$this->getTexto('clave2')) {
                    $this->_view->_error = 'Debe Introducir la Nueva Contraseña';
                    $this->_view->renderizar('clave', 'perfil', 'clave');
                    exit;
                }

                if (!$this->getTexto('clave3')) {
                    $this->_view->_error = 'Debe Introducir la Contraseña para confirmar';
                    $this->_view->renderizar('clave', 'perfil', 'clave');
                    exit;
                }

                if ($this->getTexto('clave2') != $this->getTexto('clave3')) {
                    $this->_view->_error = 'Las Contraseñas no coinciden';
                    $this->_view->renderizar('clave', 'perfil', 'clave');
                    exit;
                }

                $this->_registro->cambiarClave(
                        $id,
                        $this->getPostParam('clave2')
                        );
                echo "<script>alert('Contraseña cambiada satisfactoriamente...')</script>";
                $this->redireccionar2('registro/lista', 0.1);
            }
        }
        $this->_view->renderizar('clave', 'perfil', 'clave');
    }
    
    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('registro/lista');
        }

        if (!$this->_registro->getUsuario($id)) {
            $this->redireccionar('registro/lista');
        }

        $this->_registro->eliminarUsuario($id);
        $this->redireccionar('registro/lista');
    }
}
