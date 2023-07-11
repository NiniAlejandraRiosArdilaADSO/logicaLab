<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>punto uno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
// Inicializar la sesión
$nombre = "";
$edad = "";
$peso = "";

session_start();

if(isset($_POST['enviar'])){
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $peso = $_POST['peso'];

    // Calcular la edad en base a la fecha de nacimiento
    $edad = calcularEdad($fechaNacimiento);

    // Determinar la categoría de edad
    $categoria = determinarCategoriaEdad($edad);

    // Guardar la información de la persona en la sesión
    $_SESSION['personas'][] = array(
        'nombre' => $nombre,
        'fecha_nacimiento' => $fechaNacimiento,
        'edad' => $edad,
        'peso' => $peso,
        'categoria' => $categoria
    );{}
}

    // boton  borrar


// function borrar(){
//     if (isset($_POST["borrar"])) {
//         session_start();
//         session_destroy();
//         header('Location: index.php');
//     }
    
// }

    

// Calcular la edad en base a la fecha de nacimiento
function calcularEdad($fechaNacimiento){
    $fechaActual = date('Y-m-d');
    $diff = date_diff(date_create($fechaNacimiento), date_create($fechaActual));
    return $diff->y;
}

// Determinar la categoría de edad
function determinarCategoriaEdad($edad){
    if($edad >= 0 && $edad <= 12){
        return 'Niños';
    }elseif($edad >= 13 && $edad <= 29){
        return 'Jóvenes';
    }elseif($edad >= 30 && $edad <= 59){
        return 'Adultos';
    }else{
        return 'Viejos';
    }
}

// Obtener la lista de personas almacenadas en la sesión

$personas = isset($_SESSION['personas']) ? $_SESSION['personas'] : array();

// Calcular el promedio de peso por categoría de edad

$promedios = array(
    'Niños' => calcularPromedioPeso($personas, 'Niños'),
    'Jóvenes' => calcularPromedioPeso($personas, 'Jóvenes'),
    'Adultos' => calcularPromedioPeso($personas, 'Adultos'),
    'Viejos' => calcularPromedioPeso($personas, 'Viejos')
);

// Calcular el promedio de peso por categoría de edad

function calcularPromedioPeso($personas, $categoria){
    $totalPeso = 0;
    $contador = 0;

    foreach($personas as $persona){
        if($persona["categoria"] == $categoria){
            $totalPeso += $persona['peso'];
            $contador++;
        }
    }

    if($contador > 0){
        return round($totalPeso / $contador, 2);
    }else{
        return 0;
    }
}


?>
    <div class=""container>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-4 " >
                    <div class="card-header">
                    <h1 class="mt-4">Muestreo</h1>
                    <div class="card-body">
                    <form method="POST" action="" class="mt-4" id="formulario">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="peso">Peso:</label>
                            <input type="number" id="peso" name="peso" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" name="enviar" class="btn btn-primary">Agregar</button>
                    </form>
                    <br>
                    <form action="eliminar.php">
                        <button type="submit" class="btn btn-primary" name="sessionDestroy" value="Cerrar sesion" >borrar</button>
                    </form>
                    
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 mt-4"> 
            <div class="card">
                <div class="card-body">
                    <h2>Resultado</h2>
                    <div id="resultados">
                        <?php if(!empty($personas)): ?>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Peso</th>
                                        <th>Categoría</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($personas as $persona): ?>
                                        <tr>
                                            <td><?php echo $persona['nombre']; ?></td>
                                            <td><?php echo $persona['edad']; ?></td>
                                            <td><?php echo $persona['peso']; ?></td>
                                            <td><?php echo $persona['categoria']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <div class="row justify-content-center">
                                <div class="col-md-6 mt-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Promedio de Peso por Categoría:</h4>
                                            <ul class="list-group">
                                                <?php foreach($promedios as $categoria => $promedio): ?>
                                                    <li><?php echo $categoria; ?>: <?php echo $promedio; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <p>No hay resultados disponibles.</p>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="validar.js"></script>
</body>
</html>