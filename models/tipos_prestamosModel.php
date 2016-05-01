<?php

class tipos_prestamosModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM tipos_prestamos");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM tipos_prestamos WHERE id_tip_pre = $id");
        return $var->fetch();
    }
    
    public function insertarDatos($nombre, $interes) {
        $this->_db->query("INSERT INTO tipos_prestamos VALUES(NULL, '$nombre', '$interes')");
    }
    
    public function editarDatos($id, $nombre, $interes) {
        $this->_db->query("UPDATE tipos_prestamos SET nombre_tip_pre = '$nombre', interes_tip_pre = '$interes' WHERE id_tip_pre = $id");
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM tipos_prestamos WHERE id_tip_pre = '$id'");
    }
}
