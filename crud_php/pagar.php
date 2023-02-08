<?php
session_start(); 
// Función que me conecta a la base de datos que está en config/connection.php
require_once "config/connection.php";
require_once "config/config.php";
//Función que me permite usar las variables de sesión
if (!isset($_SESSION['email'])) {
  header('Location: inicio.php');
}

$email = $_SESSION['email'];

$query = "SELECT usuario.nombre, usuario.apellido, usuario.telefono, ciudades.nombre as nombre_ciu FROM usuario
JOIN ciudades ON usuario.cod_ciu = ciudades.cod_ciu
WHERE usuario.email = '$email'";
$result = pg_query($conn, $query);
$row = pg_fetch_assoc($result);

?>

<form action="procesar_pago.php" method="post">
  <input type="hidden" name="email" value="<?php echo $email; ?>">
  <label>Nombre:</label>
  <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" readonly>
  <label>Apellido:</label>
  <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>" readonly>
  <label>Teléfono:</label>
  <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" readonly>
  <label>Ciudad:</label>
  <input type="text" name="ciudad" value="<?php echo $row['nombre_ciu']; ?>" readonly>
  <label>Número de tarjeta de crédito:</label>
  <input type="text" name="numero_tarjeta">
  <label>Fecha de vencimiento:</label>
  <input type="text" name="fecha_vencimiento">
  <label>CVV:</label>
  <input type="text" name="cvv">
  <label>Dirección de envío:</label>
  <input type="text" name="direccion_envio">
  <input type="submit" value="Pagar">
</form>
