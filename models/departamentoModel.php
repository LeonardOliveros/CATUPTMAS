<?php

class departamentoModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM departamentos");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM departamentos WHERE id_dep = $id");
        return $var->fetch();
    }
    
    public function insertarDatos($codigo, $departamento) {
        $this->_db->query("INSERT INTO departamentos VALUES(NULL, '$codigo', '$departamento')");
    }
    
    public function editarDatos($id, $codigo, $departamento) {
        $this->_db->query("UPDATE departamentos SET codigo_dep = '$codigo', nombre_dep = '$departamento' WHERE id_dep = $id");
    }

    public function getNombre($departamento) {
        $var = $this->_db->query("SELECT COUNT(*) AS cant, departamentos.* FROM departamentos WHERE nombre_dep = '$departamento'");
        return $var->fetch();
    }

    public function getCodigo($codigo) {
        $var = $this->_db->query("SELECT COUNT(*) AS cant, departamentos.* FROM departamentos WHERE codigo_dep = '$codigo'");
        return $var->fetch();
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM departamentos WHERE id_dep = '$id'");
    }
}
