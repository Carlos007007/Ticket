<?php
include '../lib/class_mysql.php';
include '../lib/config.php';

$sql=  Mysql::consulta("SELECT nombre_usuario FROM cliente WHERE nombre_usuario='".MysqlQuery::RequestGet('id')."'");

if(mysqli_num_rows($sql)>0){
    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
    echo '<label class="control-label" for="inputSuccess2" style="margin-top:10px;";>El usuario ya existe, por favor elige otro nombre de usuario</label>';
}else{
    echo '<span class="glyphicon glyphicon-ok form-control-feedback"></span>';
}