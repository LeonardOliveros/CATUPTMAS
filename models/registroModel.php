<?php

class registroModel extends Model
{

    public function __construct() {
        parent::__construct();
    }
    
    public function verificarUsuario($usuario) {
        $id = $this->_db->query("SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'");
        return $id->fetch();
    }
    
    public function registrarUsuario($usuario, $nombre, $password, $role) {
        $this->_db->query("INSERT INTO usuarios VALUES(null, '$nombre', '$usuario', '".Hash::getHash('sha1', $password, HASH_KEY)."', '$role', 1)");
    }
    
    public function editarUsuario($id, $nombre) {
        $this->_db->query("UPDATE usuarios SET nombre = '$nombre' WHERE id_usuario = $id");
    }
    
    public function cambiarClave($id, $password) {
        $this->_db->query("UPDATE usuarios SET pass = '".Hash::getHash('sha1', $password, HASH_KEY)."' WHERE id_usuario = $id");
    }
    
    public function cambiarRol($id, $rol) {
        $this->_db->query("UPDATE usuarios SET role = '$rol' WHERE id_usuario = $id");
    }
    
    public function getUsuario($id) {
        $usuario = $this->_db->query("SELECT usuarios.*, roles.* FROM usuarios INNER JOIN roles ON roles.id_rol=usuarios.role WHERE usuarios.id_usuario = $id");
        return $usuario->fetch();
    }
    
    public function getUsuario2($usuario, $pass) {
        $usuario = $this->_db->query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass = '".Hash::getHash('sha1', $pass, HASH_KEY)."'");
        return $usuario->fetch();
    }
    
    public function getRoles() {
        $usuario = $this->_db->query("SELECT * FROM roles");
        return $usuario->fetchall();
    }
    
    public function getUsuarios() {
        $usuario = $this->_db->query("SELECT usuarios.*, roles.* FROM usuarios INNER JOIN roles ON roles.id_rol=usuarios.role ORDER BY usuarios.id_usuario");
        return $usuario->fetchall();
    }
    
    public function eliminarUsuario($id){
        $this->_db->query("DELETE FROM usuarios WHERE id_usuario = $id");
    }
}
