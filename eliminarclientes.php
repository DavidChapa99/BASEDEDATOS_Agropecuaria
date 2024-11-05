<!--#Creado por David Chaparro-->
<?php
$server = "localhost";
$user = "root";
$passw = "";
$db = "dbagrostma";
$conexion = new mysqli($server,$user,$passw,$db);

if(isset($_POST['listeliminar'])){
    $lista=implode("', '",$_POST['listeliminar']);
    $sql = "delete from clientes where NOMBRE in ('$lista')";
    $result=$conexion->query($sql);
}else{
    echo "<script> 
    alert('ERROR');
    </script>";
}
$conexion->close();
header("location: clientes.php");
?>