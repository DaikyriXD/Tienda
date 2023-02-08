<?php
require_once "config/connection.php";
if (isset($_POST)) {
    if ($_POST['action'] == 'buscar') {
        $array['datos'] = array();
        $total = 0;
        for ($i=0; $i < count($_POST['data']); $i++) { 
            $id = $_POST['data'][$i]['id'];
            $query = pg_query($dbconn, "SELECT * FROM productos WHERE id = $id");
            $result = pg_fetch_assoc($query);
            $data['id'] = $result['id'];
            $data['precio'] = $result['precio'];
            $data['nombre'] = $result['nombre'];
            $total = $total + $result['precio'];
            array_push($array['datos'], $data);
        }
        $array['total'] = $total;
        echo json_encode($array);
        die();
    }
}

?>