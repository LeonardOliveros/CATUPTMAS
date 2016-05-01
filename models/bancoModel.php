<?php

class bancoModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM bancos");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM bancos WHERE id_ban = $id");
        return $var->fetch();
    }

    public function getCodigo($codigo) {
        $var = $this->_db->query("SELECT COUNT(*) AS cant, bancos.* FROM bancos WHERE codigo_ban = '$codigo'");
        return $var->fetch();
    }
    
    public function insertarDatos($codigo, $banco, $numero_cuenta, $tipo_cuenta) {
        $this->_db->query("INSERT INTO bancos VALUES(NULL, '$codigo', '$banco', '$numero_cuenta', '$tipo_cuenta', 0)");
    }
    
    public function editarDatos($id, $codigo, $banco, $numero_cuenta, $tipo_cuenta) {
        $this->_db->query("UPDATE bancos SET codigo_ban = '$codigo', nombre_ban = '$banco', numero_cuenta_ban = '$numero_cuenta', tipo_cuenta_ban = '$tipo_cuenta' WHERE id_ban = $id");
    }

    public function sumarActivos($id, $monto) {
        $this->_db->query("UPDATE bancos SET monto_ban = monto_ban + $monto WHERE id_ban = $id");
    }

    public function restarActivos($id, $monto) {
        $this->_db->query("UPDATE bancos SET monto_ban = monto_ban - $monto WHERE id_ban = $id");
    }

    public function getNumeroCuenta($numero_cuenta) {
        $var = $this->_db->query("SELECT COUNT(*) AS cant, bancos.* FROM bancos WHERE numero_cuenta_ban = '$numero_cuenta'");
        return $var->fetch();
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM bancos WHERE id_ban = '$id'");
    }

    public function getMovimientos($id, $mes, $ao) {
        $var = $this->_db->query("SELECT * FROM movimientos AS m INNER JOIN socios AS s ON m.socio_mov = s.id_soc INNER JOIN bancos AS b ON m.banco_mov = b.id_ban WHERE b.id_ban = $id AND MONTH(m.fecha_mov) = $mes AND YEAR(m.fecha_mov) = $ao ORDER BY m.id_mov DESC");
        return $var->fetchall();
    }
}
