<?php

require_once ("config.php");

//Carrega um único usuário:
//$user = new Usuario();
//$user->loadById(9);
//echo $user;

//Carrega uma lista de usuários:
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários buscando pelo login:
//$busca = Usuario::search("Jo");
//var_dump($busca);

//Carrega um usuário usando o login e a senha:
//$usuario = new Usuario();
//$usuario->login("Joao", "1234590");
//echo $usuario;

$aluno = new Usuario();
$aluno->setLogin("aluno1");
$aluno->setSenha("@lun0");
$aluno->insert();

echo $aluno;
?>

