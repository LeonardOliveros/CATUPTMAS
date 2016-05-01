<?php

class categoriaModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM categorias");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM categorias WHERE id_cat = $id");
        return $var->fetch();
    }
    
    public function insertarDatos($nombre) {
        $this->_db->query("INSERT INTO categorias VALUES(NULL, '$nombre')");
    }
    
    public function editarDatos($id, $nombre) {
        $this->_db->query("UPDATE categorias SET nombre_cat = '$nombre' WHERE id_cat = $id");
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM categorias WHERE id_cat = '$id'");
    }
}
