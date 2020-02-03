<?php

require_once("config.php");

/*
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

/*
$root = new Usuarios();

$root->loadById(4);

echo $root;
*/

/*
$lista = Usuarios::getList();

echo json_encode($lista);
*/

/*
$search = Usuarios::search("MADRU");

echo json_encode($search);



$usuario = new Usuarios();

$a = "MADRUGUINHA";

$B = "KAUKAUKAUKAU";

$usuario->login($a, $B);

echo $usuario;

*/
/*
$aluno = new Usuarios("Piracanjuba", "PI-RA-CAN-JU-BA");
/*
$aluno->setDeslogin("DR. Piraporinhas");
$aluno->setDessenha("Senha do DR. Piraporinhas");


$aluno->insert();

echo $aluno;
*/

$usuarios = new Usuarios();

$usuarios->loadById(8);

$usuarios->update("Prof. Girafalles", "AquelaVelhaNaoAdocaOMeuCafe");

echo $usuarios;
