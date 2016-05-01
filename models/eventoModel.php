<?php

class eventoModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM eventos");
        return $var->fetchall();
    }

    public function getAll2($estado) {
        $var = $this->_db->query("SELECT * FROM eventos WHERE estado_eve = '$estado'");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM eventos WHERE id_eve = $id");
        return $var->fetch();
    }
    
    public function insertarDatos($evento, $fecha_inicio, $fecha_fin, $descripcion, $estado) {
        $this->_db->query("INSERT INTO eventos VALUES(NULL, '$evento', '$fecha_inicio', '$fecha_fin', '$descripcion', '$estado')");
    }
    
    public function editarDatos($id, $evento, $fecha_inicio, $fecha_fin, $descripcion, $estado) {
        $this->_db->query("UPDATE eventos SET nombre_eve = '$evento', fecha_inicio_eve = '$fecha_inicio', fecha_fin_eve = '$fecha_fin', descripcion_eve = '$descripcion', estado_eve = '$estado' WHERE id_eve = $id");
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM eventos WHERE id_eve = '$id'");
    }

    public function getEventosVencidos($date) {
        $var = $this->_db->query("SELECT * FROM eventos WHERE estado_eve = 'Activo' AND fecha_fin_eve < '$date'");
        return $var->fetchall();
    }

    public function cambiarEstadoEvento($id, $estado) {
        $this->_db->query("UPDATE eventos SET estado_eve = '$estado' WHERE id_eve = $id");
    }

}
