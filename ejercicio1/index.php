<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laboratorio logica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php

    session_start();

    if (!isset($_SESSION[persona])) {
        $_SESSION["persona"] = array();    
    }

    if (isset($_POST["nom"])) {
        $nom = isset($_POST["nom"]) ? $_POST["nom"] : "" ;
        $peso = isset($_POST["peso"]) ? $_POST["peso"] : "" ;
        $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : "" ;
    }
    
        if ($nom == "") {
            echo '<script> alert("llene el campo de nombre ); </script>';
        }
        if ($peso == "") {
            echo '<script> alert("llene el campo de peso ); </script>';
        }
        if ($fecha == "") {
            echo '<script> alert("llene el campo de fecha ); </script>';
        }else {
            echo '<script> alert("se envian datos")"</script>';
            $persona = [
                "nombre" => $nom,
                "peso" => $peso,
                "fecha" => $fecha,
            ];

            array_push($_SESSION["persona"], $persona);

            if ($fecha > 0 && $fecha <= 12) {
                echo "";
            }
        }

    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">  
                <div class="card mt-4">
                    <div class="card-header">
        <h2>Formulario de Mutreo</h2>
            
            <form action="index.php "method="post" id="formulario" >
                <div>
                <label for="nom" class="form-label">Ingrese el nombre</label>
                <input type="text"  class="form-control" name="nom" id="nom">
                </div>
                <div>
                <label for="peso" class="form-label">Ingrese el peso</label>
                <input type="text"  class="form-control" name="peso" id="peso">
                </div>
                <div>
                <label for="fecha" class="form-label">Ingrese fecha de nacimiento </label>
                <input type="date"  class="form-control" name="fecha" id="fecha">
                </div><p>   
                <div class=d-grid>
                <button id="btnenviar" type="submit" class="btn btn-primary">enviar</button>
                </div>
            </form>
                    </div>
                </div>  
            </div>
        </div>   
    </div>
    <div>
        <?php
        include "muestreo.php";
        ?>
    </div>
    <script src="validar.js"></script>
</body>
</html>