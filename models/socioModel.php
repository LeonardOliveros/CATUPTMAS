<?php

class socioModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT * FROM socios AS s INNER JOIN departamentos AS d ON s.departamento_soc = d.id_dep INNER JOIN categorias AS c ON s.categoria_soc = c.id_cat");
        return $var->fetchall();
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT * FROM socios AS s INNER JOIN departamentos AS d ON s.departamento_soc = d.id_dep INNER JOIN categorias AS c ON s.categoria_soc = c.id_cat WHERE s.id_soc = $id");
        return $var->fetch();
    }

    public function getSociosDepartamento($departamento) {
        $var = $this->_db->query("SELECT * FROM socios AS s INNER JOIN departamentos AS d ON s.departamento_soc = d.id_dep INNER JOIN categorias AS c ON s.categoria_soc = c.id_cat WHERE d.id_dep = $departamento");
        return $var->fetchall();
    }
    
    public function insertarDatos($codigo, $cedula_rif, $apellidos, $nombres, $telefono, $telefono2, $direccion, $tipo, $categoria, $departamento, $sueldo, $aporte_patrono, $aporte_socio, $banco, $tipo_cuenta, $numero_cuenta) {
        $this->_db->query("INSERT INTO socios VALUES(NULL, '$codigo', '$cedula_rif', '$apellidos', '$nombres', '$telefono', '$telefono2', '$direccion', '$tipo', '$categoria', '$departamento', '$sueldo', '$aporte_patrono', '$aporte_socio', '$banco', '$tipo_cuenta', '$numero_cuenta')");
    }
    
    public function editarDatos($id, $cedula, $apellidos, $nombres, $telefono, $telefono2, $direccion, $tipo, $categoria, $departamento, $sueldo, $aporte_patrono, $aporte_socio, $banco, $tipo_cuenta, $numero_cuenta) {
        $this->_db->query("UPDATE socios SET cedula_rif_soc = '$cedula', apellidos_soc = '$apellidos', nombres_soc = '$nombres', telefono_soc = '$telefono', telefono2_soc = '$telefono2', direccion_soc = '$direccion', tipo_soc = '$tipo', categoria_soc = '$categoria', departamento_soc = '$departamento', sueldo_soc = '$sueldo', aporte_patrono_soc = '$aporte_patrono', aporte_socio_soc = '$aporte_socio', banco_soc = '$banco', tipo_cuenta_soc = '$tipo_cuenta', numero_cuenta_soc = '$numero_cuenta' WHERE id_soc = $id");
    }

    public function cambiarCodigo($id, $codigo) {
        $this->_db->query("UPDATE socios SET codigo_soc = '$codigo' WHERE id_soc = $id");
    }

    public function getCedula($cedula_rif) {
        $var = $this->_db->query("SELECT COUNT(*) AS cant, s.*, d.* FROM socios AS s INNER JOIN departamentos AS d ON s.departamento_soc = d.id_dep INNER JOIN categorias AS c ON s.categoria_soc = c.id_cat WHERE s.cedula_rif_soc = '$cedula_rif'");
        return $var->fetch();
    }

    public function getCodigo($codigo) {
        $var = $this->_db->query("SELECT s.*, d.* FROM socios AS s INNER JOIN departamentos AS d ON s.departamento_soc = d.id_dep INNER JOIN categorias AS c ON s.categoria_soc = c.id_cat WHERE s.codigo_soc = '$codigo'");
        return $var->fetch();
    }

    public function getCedulaAportes($cedula_rif) {
        $var = $this->_db->query("SELECT s.*, d.* FROM socios AS s INNER JOIN departamentos AS d ON s.departamento_soc = d.id_dep INNER JOIN categorias AS c ON s.categoria_soc = c.id_cat WHERE s.cedula_rif_soc = '$cedula_rif'");
        return $var->fetchall();
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM socios WHERE id_soc = '$id'");
    }
}
