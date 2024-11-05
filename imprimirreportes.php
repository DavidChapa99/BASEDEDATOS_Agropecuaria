<!--#Creado por David Chaparro-->
<?php
$server = "localhost";
$user = "root";
$passw = "";
$db = "dbagrostma";
$conexion = new mysqli($server,$user,$passw,$db);

$rutaexe="C:/Users/bionat/AppData/Local/Programs/Python/Python312/python.exe";
if(isset($_POST['repdiario'])){
    $rep="//ventas/Compartidos/SERVICIOS/BASEDEDATOS/Reportediario.py";
    $open=shell_exec("$rutaexe $rep");
    echo $open;
}elseif(isset($_POST['repsemanal'])){
    $rep="//ventas/Compartidos/SERVICIOS/BASEDEDATOS/reportesemanal.py";
    $open=shell_exec("$rutaexe $rep");
    echo $open;
}else{
    echo "<script> 
    alert('ERROR');
    
    </script>";
}
$conexion->close();
header("location: reportes.php");
?>