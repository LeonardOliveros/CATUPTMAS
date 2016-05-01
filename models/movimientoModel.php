<?php

class movimientoModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM movimientos AS m INNER JOIN socios AS s ON m.socio_mov = s.id_soc INNER JOIN bancos AS b ON m.banco_mov = b.id_ban");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM movimientos AS m INNER JOIN socios AS s ON m.socio_mov = s.id_soc INNER JOIN bancos AS b ON m.banco_mov = b.id_ban WHERE m.id_mov = $id");
        return $var->fetch();
    }
    
    public function insertarDatos($socio, $referencia, $fecha, $tipo, $forma, $monto, $nota, $banco, $estado) {
        $this->_db->query("INSERT INTO movimientos VALUES(NULL, '$socio', '$referencia', '$fecha', '$tipo', '$forma', '$monto', '$nota', '$banco', '$estado')");
    }
    
    public function editarDatos($id, $referencia, $fecha, $tipo, $forma, $monto, $nota, $banco, $estado) {
        $this->_db->query("UPDATE movimientos SET referencia_mov = '$referencia', fecha_mov = '$fecha', tipo_mov = '$tipo', forma_mov = '$forma', monto_mov = '$monto', nota_mov = '$nota', banco_mov = '$banco', estado_mov = '$estado' WHERE id_mov = $id");
    }

    public function getSocio($cedula_rif) {
        $var = $this->_db->query("SELECT COUNT(*) AS cant, socios.* FROM socios WHERE cedula_rif_soc = '$cedula_rif'");
        return $var->fetch();
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM movimientos WHERE id_mov = '$id'");
    }

    public function getUlt() {
        $var = $this->_db->query("SELECT MAX(id_mov) AS id FROM movimientos");
        return $var->fetch();
    }

    public function getAhorros($id, $estado) {
        $var = $this->_db->query("SELECT * FROM movimientos WHERE socio_mov = $id AND estado_mov = '$estado'");
        return $var->fetchall();
    }
}
