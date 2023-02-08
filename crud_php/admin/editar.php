<?php
require_once "../config/connection.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $p_normal = $_POST['p_normal'];
        $categoria = $_POST['categoria'];
        $img = $_FILES['foto'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../assets/img/" . $foto;
        $query = pg_query($dbconn, "INSERT INTO productos(nombre, descripcion, precio, cantidad,id_cat, imagen) VALUES ('$nombre', '$descripcion', '$p_normal', $cantidad, $categoria,'$foto')");
        if ($query) {
            if (move_uploaded_file($tmpname, $destino)) {
                header('Location: productos.php');
            }
        }
    }
}
