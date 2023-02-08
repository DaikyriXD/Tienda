<?php 
require_once "config/connection.php";
require_once "config/config.php";
session_start();
$email = $_SESSION['email'];
$query = "SELECT usuario.identificacion, usuario.nombre, usuario.apellido, usuario.telefono, usuario.direccion ciudades.nombre FROM usuario
JOIN ciudades ON usuario.cod_ciu = ciudades.cod_ciu
WHERE usuario.email = '$email'";
$result = pg_query($conn, $query);
$row = pg_fetch_assoc($result);

?>