<!--#Creado por David Chaparro-->
<?php
$server = "localhost";
$user = "root";
$passw = "";
$db = "dbagrostma";
$conexion = new mysqli($server,$user,$passw,$db);

    if(isset($_POST['enter'])){

        $NUM_CLIENTE=$_POST['NUM_CLIENTE'];
        $NOMBRE=strtoupper($_POST['NOMBRE']);
        $POBLACION=strtoupper($_POST['POBLACION']);
        $SALA=strtoupper($_POST['SALA']);
        $TELEFONO=$_POST['TELEFONO'];
        $NUM_PUESTOS=$_POST['NUM_PUESTOS'];
        $NUM_VACAS=$_POST['NUM_VACAS'];
        $NUM_ORDENOS=$_POST['NUM_ORDENOS'];
        $TIPO_LECHERA=strtoupper($_POST['TIPO_LECHERA']);

        $sql = "insert into clientes(NUM_CLIENTE,NOMBRE,POBLACION,SALA,TELEFONO,NUM_PUESTOS,NUM_VACAS,NUM_ORDENOS,TIPO_LECHERA) 
        values('".$NUM_CLIENTE."','".$NOMBRE."','".$POBLACION."','".$SALA."','".$TELEFONO."','".$NUM_PUESTOS."','".$NUM_VACAS."','".$NUM_ORDENOS."','".$TIPO_LECHERA."')"; 

        $result=$conexion->query($sql);
    }else{
        echo "<script> 
        alert('ERROR');
        header('location: clientes.php');
        </script>";
    }
$conexion->close();
header("location: clientes.php");
?>
