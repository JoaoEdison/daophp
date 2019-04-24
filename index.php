<?php

require_once ("config.php");

$SQL = new SQL;
$usuarios = $SQL->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);

?>