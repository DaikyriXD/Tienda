
<?php 
$conn_string = "host=localhost dbname=tienda user=postgres password=nomore15243"; 
$dbconn = pg_connect($conn_string) or die('Error de conexion: ' . pg_last_error()); ;

?>

