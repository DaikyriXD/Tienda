<?php
if (isset($_GET)) {
    if (!empty($_GET['accion']) && !empty($_GET['id'])) {
        require_once "../config/connection.php";
        $id = $_GET['id'];
        if ($_GET['accion'] == 'pro') {
            $query = pg_query($dbconn, "DELETE FROM productos WHERE id = $id");
            if ($query) {
                header('Location: productos.php');
            }
        }
        if ($_GET['accion'] == 'cli') {
            $query = pg_query($dbconn, "DELETE FROM categorias WHERE id = $id");
            if ($query) {
                header('Location: categorias.php');
            }
        }
    }
}
?>