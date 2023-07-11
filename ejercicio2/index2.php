<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>punto dos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">

                <h1 class="h2">Calcular Pagos</h1>
    
                <form method="POST" action="" class="mt-4">

                    <h2 class="h4">Datos de los clientes:</h2>
                    
                    <div id="clientes">
                        <div class="cliente">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="clientes[0][nombre]" required>
                            <label for="kilos1">Kilos comprados:</label>
                            <input type="number" id="kilos1" name="clientes[0][kilos]" required>
                        </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-outline-info" onclick="agregarCliente()" >Agregar Cliente</button>
                    <button type="submit" class="btn btn-outline-primary" name="submit">Calcular</button>
                </form>
                <br>
                <form action="eliminar.php">
                        <button type="submit" class="btn btn-outline-danger" name="sessionDestroy" value="Cerrar sesion" >borrar</button>
                </form>

    

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
        <div class="col-md-6 mt-4"> 
            <div class="card">
                <div class="card-body">
                <?php
// Función para calcular el monto a pagar por cada cliente y el monto total recibido por la tienda
function calcularPagos($clientes)
{
    $descuento = 0.15; // 15% de descuento
    $montoTotalRecibido = 0;
    
    foreach ($clientes as $cliente) {
        $kilosComprados = $cliente['kilos'];
        $montoAPagar = $kilosComprados;
        
        if ($kilosComprados > 10) {
            $montoAPagar = $kilosComprados * (1 - $descuento);
        }
        
        $montoTotalRecibido += $montoAPagar;
        
        echo "Cliente: " . $cliente['nombre'] . "<br>";
        echo "Kilos comprados: " . $kilosComprados . "<br>";
        echo "Monto a pagar: $" . $montoAPagar . "<br><br>";
    }
    
    echo "Monto total recibido por la tienda: $" . $montoTotalRecibido;
}

// Verificar si se envió el formulario
if (isset($_POST['submit'])) {
    // Obtener los datos de los clientes desde el formulario
    $clientes = array();
    
    foreach ($_POST['clientes'] as $cliente) {
        $nombre = $cliente['nombre'];
        $kilosComprados = $cliente['kilos'];
        
        // Crear un array con los datos del cliente
        $clientes[] = array('nombre' => $nombre, 'kilos' => $kilosComprados);
    }
    
    // Calcular los pagos
    calcularPagos($clientes);
}
?>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        var contadorClientes = 1;
        
        function agregarCliente() {
            contadorClientes++;
            
            var divClientes = document.getElementById("clientes");
            
            var divCliente = document.createElement("div");
            divCliente.classList.add("cliente");
            
            var labelNombre = document.createElement("label");
            labelNombre.textContent = "Nombre:";
            
            var inputNombre = document.createElement("input");
            inputNombre.type = "text";
            inputNombre.name = "clientes[" + contadorClientes + "][nombre]";
            inputNombre.required = true;
            
            var labelKilos = document.createElement("label");
            labelKilos.textContent = "Kilos comprados:";
            
            var inputKilos = document.createElement("input");
            inputKilos.type = "number";
            inputKilos.name = "clientes[" + contadorClientes + "][kilos]";
            inputKilos.required = true;
            
            divCliente.appendChild(labelNombre);
            divCliente.appendChild(inputNombre);
            divCliente.appendChild(labelKilos);
            divCliente.appendChild(inputKilos);
            
            divClientes.appendChild(divCliente);
        }
    </script>


</body>
</html>