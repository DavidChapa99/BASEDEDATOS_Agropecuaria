<!--#Creado por David Chaparro-->
<?php
$repdiario = fopen("reportediario.py","r");
$repsemanal = fopen("reportesemanal.py", "r");

$conexion = new mysqli("localhost","root","","dbagrostma");
$conexion->set_charset("utf8");
$sql= "SELECT * from lista_precios_ej";
$result = $conexion->query($sql);
$sqlreq = "SELECT * FROM requisicion";
$resultreq = $conexion->query($sqlreq);
?>
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
        <a href="productos.php">Productos</a>
        <a href="">Registro de Servicios</a>
        <a href="">Alarmas</a>
    </div>
    <h1><img src="imagenesdeapoyo/agropecuaria1.gif" width="230" height="150"></h1>
    <form action="imprimirreportes.php" method="post">
    <input type="submit" name="repdiario" value="Reporte Diario">
    <input type="submit" name="repsemanal" value="Reporte Semanal">
    <script>
        function formreq(){
            if(document.getElementById("genreq").style.display=="block"){
                document.getElementById("genreq").style.display="none";
            }else{
                document.getElementById("genreq").style.display="block";
            }
        }
    </script>
    </form>
    <button onclick="formreq()" >Generar Requisición</button>
    <div id="genreq" style="display:none;">
    <form action="genreq.php" method="post">
        Cantidad:<input name="cantidad" type="number">
        Producto:<input name="producto" list="lp">
        <datalist id="lp">
            <?php
            while($row=$result->fetch_assoc())
            echo "<option value='".$row['Nombre']."'>";
            ?>
        </datalist>
        <button name="accion" value="agregar">Agregar producto</button>
        <button name="accion" value="blanco">Agregar Espacio En Blanco</button>
        <button name="accion" value="limpiar">Borrar Entrada Anterior</button>
        <br>
        <button name="accion" value="imprimir">Imprimir Requisición</button>
        <button name="accion" onclick="formreq()" value="cancelar">Cancelar Requisición</button>
        <?php
        $tablareq = $resultreq->num_rows;
        if($tablareq > 0){
            echo"
            <table border='3'>
                <caption>Requisición Actual</caption>
                <tr>
                    <th>Cantidad</th>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>";
                $resultreq->data_seek(0);
                while($row=$resultreq->fetch_assoc())
                    echo "<tr><td>".
                    $row['Cantidad']."</td><td>".
                    $row['Clave']."</td><td>".
                    $row['Nombre']."</td><td>".
                    $row['Precio']."</td></tr>";
            echo "</table>";
        }
        ?>
    </form>
    <script>
        function mostrarmensaje(){
            var mensaje = "<?php echo isset($_GET['mensaje']) ? $_GET['mensaje'] : ''; ?>";
            if(mensaje.trim() !== ''){
                alert(mensaje);
            }
        }
        window.onload = function() {mostrarmensaje();};
    </script>
</body>
</html>