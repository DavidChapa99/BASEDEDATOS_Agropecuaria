<!--#Creado por David Chaparro-->
<?php
$server = "localhost";
$user = "root";
$passw = "";
$db = "dbagrostma";
$conexion = new mysqli($server,$user,$passw,$db);
if ($conexion->connect_errno){
    die("Conexion Fallida" . $conexion->connect_errno);
    } else {
        //echo "Conectado";
    }
$conexion->set_charset("utf8");
$sql = "SELECT NUM_CLIENTE, NOMBRE, POBLACION, SALA, TELEFONO, NUM_PUESTOS, NUM_VACAS, NUM_ORDENOS, TIPO_LECHERA FROM clientes";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" type="text/css" media="screen" href="clientescss.css">
    <meta http-equiv="=X-UA-Compatible" content="IE-edge">
    <title>AGROSTMA</title>
</head>
<body>
    <style>
        .topnav {
            display: flex;
            justify-content: center;
        }
    </style>
    <div class="topnav">
        <a href="productos.php">Productos</a>
        <a href="">Registro de Servicios</a>
        <a href="reportes.php">Reportes</a>
        <a href="">Alarmas</a>
    </div>
    <h1><img src="imagenesdeapoyo/agropecuaria.gif" width="230" height="200"></h1>
    <table border="2">
        <caption>Clientes de Servicios</caption>
        <tr>
            <th>Numero de cliente</th>
            <th>Nombre</th>
            <th>Poblacion</th>
            <th>Sala</th>
            <th>Telefono</th>
            <th>Numero de puestos</th>
            <th>Numero de vacas</th>
            <th>Numero de ordeños</th>
            <th>Tipo de lecheria</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc())
            echo "<tr><td><a href='".$row['NUM_CLIENTE'].".php'>".
            $row['NUM_CLIENTE']."</a></td><td>".
            $row['NOMBRE']."</td><td>".
            $row['POBLACION']."</td><td>".
            $row['SALA']."</td><td>".
            $row['TELEFONO']."</td><td>".
            $row['NUM_PUESTOS']."</td><td>".
            $row['NUM_VACAS']."</td><td>".
            $row['NUM_ORDENOS']."</td><td>".
            $row['TIPO_LECHERA']."</td></tr>";
        ?>
    </table>
    <button onclick="formularioagregar()">Agregar Cliente</button>
    <div id="agregar" style="display: none;">
        <form action="agregarcliente.php" method="post">
            <label for="NUM_CLIENTE">NUM_CLIENTE:</label><input type="text" id="NUM_CLIENTE" name="NUM_CLIENTE">
            <label for="NOMBRE">NOMBRE:</label><input type="text" id="NOMBRE" name="NOMBRE">
            <br>
            <label for="POBLACION">POBLACION:</label><input type="text" id="POBLACION" name="POBLACION">
            <label for="SALA">SALA:</label><input type="text" id="SALA" name="SALA">
            <label for="TELEFONO">TELEFONO:</label><input type="number" id="TELEFONO" name="TELEFONO">
            <br>
            <label for="NUM_PUESTOS">NUM_PUESTOS:</label><input type="number" id="NUM_PUESTOS" name="NUM_PUESTOS">
            <label for="NUM_VACAS">NUM_VACAS:</label><input type="number" id="NUM_VACAS" name="NUM_VACAS">
            <label for="NUM_ORDENOS">NUM_ORDENOS:</label><input type="number" id="NUM_ORDENOS" name="NUM_ORDENOS">
            <br>
            <label for="TIPO_LECHERA">TIPO_LECHERA:</label><input type="text" id="TIPO_LECHERA" name="TIPO_LECHERA">
            <br>
            <input type="submit" name="enter" Value="Agregar">
            <input type="button" onclick="formulariocancelar()" value="Cancelar">
        </form>
    </div>
    <script>
        function formularioagregar(){
            document.getElementById("agregar").style.display="block";
        }
        function formulariocancelar(){
            document.getElementById("agregar").style.display="none";
        }
    </script>
    
    <button onclick="formularioeditar()">Editar Cliente</button>
    <div id="editar" style="display: none;">
        <form action="editarclientes.php" method="post">
            Seleccione el cliente a editar:<br>
            <input list="listaeditar" name="edit">
            <datalist id="listaeditar">
            <?php
            $result->data_seek(0);
            while ($row = $result->fetch_assoc())
            echo "<option value='".$row['NOMBRE']."'>";
            ?>
            </datalist>
            ¿Qué campo se editará?:
            <input list="ncolumna" name="opedit">
            <datalist id="ncolumna">
                <option value="NUM_CLIENTE">
                <option value="NOMBRE">
                <option value="POBLACION">
                <option value="SALA">
                <option value="TELEFONO">
                <option value="NUM_PUESTOS">
                <option value="NUM_VACAS">
                <option value="NUM_ORDENOS">
                <option value="TIPO_LECHERA">
            </datalist>
            Introduce el nuevo valor:
            <input type="text" name="nuevovalor">
            <br>
            <input type="submit" value="Editar">
            <input type="button" onclick="formularioceditar()" value="Cancelar">
        </form>
    </div>
    <script>
        function formularioeditar(){
            document.getElementById("editar").style.display="block";
        }
        function formularioceditar(){
            document.getElementById("editar").style.display="none";
        }
    </script>

    <button onclick="formularioeliminar()">Eliminar Cliente</button>
    <div id="eliminar" style="display: none;">
        <form action="eliminarclientes.php" method="post">
            Seleccione el/los clientes a eliminar:<br>
            <?php
            $result->data_seek(0);
            while ($row = $result->fetch_assoc())
            echo "<input type='checkbox' name='listeliminar[]' value='".$row['NOMBRE']."'>".$row['NOMBRE']."<br>";
            ?>
            <input type="submit" value="Eliminar">
            <input type="button" onclick="formularioceliminar()" value="Cancelar">
        </form>
    </div>
    <script>
        function formularioeliminar(){
            document.getElementById("eliminar").style.display="block";
        }
        function formularioceliminar(){
            document.getElementById("eliminar").style.display="none";
        }
    </script>
    

</body>
</html>
<?php
$conexion->close();
?>