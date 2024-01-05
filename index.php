<?php
    require_once "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/dist/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/dist/toastr.min.css" />
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <?php
                $sql_input_dinamico = "SELECT * FROM input_dinamico";
                $result_input_dinamico = mysqli_query($conexion, $sql_input_dinamico);
                while($rid = $result_input_dinamico->fetch_assoc()) {
                    echo '
                        <div class="col-4">
                            <input type="text" class="form-control input-dinamico" data-tabla="input_dinamico" data-id="'. $rid['id'] .'" data-campo="nombre" value="'. $rid['nombre'] .'">
                        </div>
                    ';
                }
            ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('.form-control').on('change', function() {
            var tabla = $(this).data('tabla');
            var id = $(this).data('id');
            var campo = $(this).data('campo');
            var valor = $(this).val();
            var valorAnterior = $(this).data('valor-anterior');

            // Verifica si el valor ha cambiado
            if (valorAnterior !== valor) {
                // Realizar la solicitud AJAX solo si el valor ha cambiado
                $.ajax({
                    url: 'guardar_cambio.php',
                    method: 'POST',
                    data: { modelo: tabla, id: id, campo: campo, valor: valor },
                    success: function(response) {
                        // Mostrar notificación Toastr en éxito
                        toastr.success('Cambio guardado con éxito');
                        console.log(response);
                    },
                    error: function(error) {
                        // Mostrar notificación Toastr en caso de error
                        toastr.error('Error al guardar el cambio');
                        console.error(error);
                    }
                });
            }
        }).on('focus', function() {
            // Almacena el valor actual cuando el campo obtiene el foco
            $(this).data('valor-anterior', $(this).val());
        });
    });
</script>

</body>
</html>