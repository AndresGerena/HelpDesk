<?php 

$idUSuario = $_POST['idUsuario'];
include "../../clases/Usuarios.php";
$Usuarios = new Usuarios();
echo json_decode($Usuarios->obtenerDatosUsuario($idUSuario));
