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
$sql = "SELECT * FROM lista_precios_ej";
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
        <a href="clientes.php">Clientes</a>
        <a href="">Registro de Servicios</a>
        <a href="reportes.php">Reportes</a>
        <a href="">Alarmas</a>
    </div>
    <h1><img src="imagenesdeapoyo/agropecuaria.gif" width="230" height="200"></h1>
    
    <button onclick="formularioagregar()">Agregar Producto</button>
    <div id="agregar" style="display: none;">
        <form action="agregarproducto.php" method="post">
            <label for="Codigo">Codigo:</label><input type="text" id="Codigo" name="Codigo">
            <label for="Nombre">Nombre:</label><input type="text" id="Nombre" name="Nombre">
            <br>
            <label for="Cantidad">Cantidad:</label><input type="text" id="Cantidad" name="Cantidad">
            <label for="Unidad">Unidad:</label><input type="text" id="Unidad" name="Unidad">
            <label for="Ultimo_Costo">Ultimo_Costo:</label><input type="text" id="Ultimo_Costo" name="Ultimo_Costo">
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
    
    <button onclick="formularioeditar()">Editar Producto</button>
    <div id="editar" style="display: none;">
        <form action="editarproductos.php" method="post">
            Seleccione el producto a editar:<br>
            <input list="listaeditar" name="edit">
            <datalist id="listaeditar">
            <?php
            $result->data_seek(0);
            while ($row = $result->fetch_assoc())
            echo "<option value='".$row['Nombre']."'>";
            ?>
            </datalist>
            ¿Qué campo se editará?:
            <input list="ncolumna" name="opedit">
            <datalist id="ncolumna">
                <option value="Codigo">
                <option value="Nombre">
                <option value="Cantidad">
                <option value="Unidad">
                <option value="Ultimo_Costo">
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

    <button onclick="formularioeliminar()">Eliminar Producto</button>
    <div id="eliminar" style="display: none;">
        <form action="eliminarproductos.php" method="post">
            Seleccione el/los productos a eliminar:<br>
            <?php
            $result->data_seek(0);
            while ($row = $result->fetch_assoc())
            echo "<input type='checkbox' name='listeliminar[]' value='".$row['Nombre']."'>".$row['Nombre']."<br>";
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
    
    <table border="2">
        <caption>Lista de Productos</caption>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Ultimo_Costo</th>
        </tr>
        <?php
        $result->data_seek(0);
        while ($row = $result->fetch_assoc())
            echo "<tr><td>".
            $row['Codigo']."</td><td>".
            $row['Nombre']."</td><td>".
            $row['Cantidad']."</td><td>".
            $row['Unidad']."</td><td>".
            $row['Ultimo_Costo']."</td></tr>";
        ?>
    </table>
    
</body>
</html>
<?php
$conexion->close();
?>