<?php

class plazos_prestamosModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM plazos_prestamos");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM plazos_prestamos WHERE id_pla_pre = $id");
        return $var->fetch();
    }

    public function getCodigo($codigo) {
        $var = $this->_db->query("SELECT * FROM plazos_prestamos WHERE codigo_pla_pre = '$codigo'");
        return $var->fetch();
    }

    public function getNombre($nombre) {
        $var = $this->_db->query("SELECT * FROM plazos_prestamos WHERE nombre_pla_pre = '$nombre'");
        return $var->fetch();
    }
    
    public function insertarDatos($codigo, $nombre, $meses) {
        $this->_db->query("INSERT INTO plazos_prestamos VALUES(NULL, '$codigo', '$nombre', '$meses')");
    }
    
    public function editarDatos($id, $codigo, $nombre, $meses) {
        $this->_db->query("UPDATE plazos_prestamos SET codigo_pla_pre = '$codigo', nombre_pla_pre = '$nombre', meses_pla_pre = '$meses' WHERE id_pla_pre = $id");
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM plazos_prestamos WHERE id_pla_pre = '$id'");
    }
}
