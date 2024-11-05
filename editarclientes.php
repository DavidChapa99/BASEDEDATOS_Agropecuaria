<!--#Creado por David Chaparro-->
<?php
$server = "localhost";
$user = "root";
$passw = "";
$db = "dbagrostma";
$conexion = new mysqli($server,$user,$passw,$db);

if(isset($_POST['nuevovalor'])){
    $nombre = $_POST['edit'];
    $columna = $_POST['opedit'];
    $nvalor = strtoupper($_POST['nuevovalor']);
    $sql = "update clientes set ".$columna." = '".$nvalor."' where NOMBRE = '".$nombre."'";
    $result=$conexion->query($sql);
    echo $sql;
}else{
    echo "<script> 
    alert('ERROR');
    header('location: clientes.php');
    </script>";
}
$conexion->close();
header("location: clientes.php");
?>