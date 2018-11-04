<?php

class Mysql {

    public static function Conectar(){
        if(!$con=  mysqli_connect(SERVER,USER,PASS,BD)){
            echo "Error en el servidor, verifique sus datos";
        }
        /* Codificar la información de la base de datos a UTF8*/
        mysqli_set_charset($con, "utf8");
        return $con;  
    }

    public static function consulta($query) {
        if (!$consul = mysqli_query(Mysql::Conectar(), $query)) {
            echo 'Error en la consulta SQL ejecutada';
        }
        return $consul;
    }

}

class MysqlQuery {

    public static function limpiarCadena($valor) {
        $valor = str_ireplace("SELECT", "", $valor);
        $valor = str_ireplace("COPY", "", $valor);
        $valor = str_ireplace("DELETE", "", $valor);
        $valor = str_ireplace("DROP", "", $valor);
        $valor = str_ireplace("DUMP", "", $valor);
        $valor = str_ireplace(" OR ", "", $valor);
        $valor = str_ireplace("%", "", $valor);
        $valor = str_ireplace("LIKE", "", $valor);
        $valor = str_ireplace("--", "", $valor);
        $valor = str_ireplace("^", "", $valor);
        $valor = str_ireplace("[", "", $valor);
        $valor = str_ireplace("]", "", $valor);
        $valor = str_ireplace("\\", "", $valor);
        $valor = str_ireplace("!", "", $valor);
        $valor = str_ireplace("¡", "", $valor);
        $valor = str_ireplace("?", "", $valor);
        $valor = str_ireplace("=", "", $valor);
        $valor = str_ireplace("&", "", $valor);
        return $valor;
    }

    public static function RequestGet($val) {
        $data = addslashes($_GET[$val]);
        $var = utf8_decode($data);
        $datos = MysqlQuery::limpiarCadena($var);
        return $datos;
    }

    public static function RequestPost($val) {
        $data = addslashes($_POST[$val]);
        $var = utf8_decode($data);
        $datos = MysqlQuery::limpiarCadena($var);
        return $datos;
    }

    public static function Guardar($tabla, $campos, $valores) {
        if (!$sql = Mysql::consulta("INSERT INTO $tabla ($campos) VALUES($valores)", Mysql::Conectar())) {
            die("Error al insertar los datos en la tabla $tabla");
        }

        return $sql;
    }

    public static function Eliminar($tabla, $condicion) {
        if (!$sql = Mysql::consulta("DELETE FROM $tabla WHERE $condicion")) {
            die("Error al eliminar registros en la tabla $tabla");
        }

        return $sql;
    }

    public static function Actualizar($tabla, $campos, $condicion) {
        if (!$sql = Mysql::consulta("UPDATE $tabla SET $campos WHERE $condicion")) {
            die("Error al actualizar datos en la tabla $tabla");
        }
        return $sql;
    }
}

