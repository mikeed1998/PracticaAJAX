<?php
    require_once "conexion.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $modelo = $_POST['modelo'];
        $id = $_POST['id'];
        $campo = $_POST['campo'];
        $valor = $_POST['valor'];

        $sql = "UPDATE $modelo SET $campo = '$valor' WHERE id = $id";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conexion)]);
        }
    }
