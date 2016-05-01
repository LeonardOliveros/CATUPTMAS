<?php

class loginModel extends Model
{

    public function __construct() {
        parent::__construct();
    }
    
    public function getUsuario($usuario, $password) {
        $datos = $this->_db->query("SELECT * FROM usuarios, roles WHERE usuarios.role = roles.id_rol AND usuarios.usuario = '$usuario' AND usuarios.pass = '".Hash::getHash('sha1', $password, HASH_KEY)."'");
        return $datos->fetch();
    }
}
