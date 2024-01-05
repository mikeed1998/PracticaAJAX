<?php

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'php_ajax';

    $conexion = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        printf("La conexión fallo: %s\n", mysqli_connect_error());
        exit();
    }