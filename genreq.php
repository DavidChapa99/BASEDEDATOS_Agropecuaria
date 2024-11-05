<!--#Creado por David Chaparro-->
<?php
#leer archivo .py
$requisicion = fopen("requisicion.py","r");
#conexion a la base de datos
$conexion = new mysqli("localhost","root","","dbagrostma");
$conexion->set_charset("utf8");
#Ruta del ejecutable de python y del archivo
$rutaexe='"C:/Program Files/Spyder/Python/python.exe"';
$req='"//VENTAS/Compartidos/SERVICIOS/BASEDEDATOS/requisicion.py"';
#comprobar si se envio el formulario
if($_SERVER['REQUEST_METHOD']=='POST'){
    #asignacion de la variable accion de los fomularios a una variable en este php
    $accion = $_POST['accion'];
    if($accion=="agregar"){
        #codigo para agregar a la tabla de requisicion
        #asignacion de variables
        $cantidad=$_POST['cantidad'];
        $producto=$_POST['producto'];
        #consultamos el codigo y precio del producto a agregar
        $consulta=$conexion->query("SELECT * FROM lista_precios_ej WHERE Nombre = '$producto'");
        #Asignamos los datos de la consulta a una variable cada uno, corroborando que si se haya hecho la consulta correctamente
        if($consulta){
            #se asigna los otros valores obtenidos de la consulta a la bd de lista de precios para agregarlos
            $codigoyprecio = $consulta->fetch_assoc();
            $clave=$codigoyprecio['Codigo'];
            $precio=$codigoyprecio['Ultimo_Costo'];
            #intrucciones para insertar en la tabla
            $sql="INSERT INTO requisicion (Cantidad,Clave,Nombre,Precio) VALUES('$cantidad','$clave','$producto','$precio')";
            $conexion->query($sql);
            header("Location:reportes.php? mensaje=Agregado Correctamente ".$producto);
            exit();
        }
        #mensaje de error al agregar
        header("Location:reportes.php? mensaje=Agregado Incorrectamente $producto");
        exit();
    }elseif($accion=="blanco"){
        #codigo para agregar espacio en blanco
        $sql="INSERT INTO requisicion (Cantidad,Clave,Nombre,Precio) VALUES(NULL,'','','')";
        $conexion->query($sql);
        header("Location:reportes.php? mensaje=Agregado Correctamente");
        exit();
    }elseif($accion=="limpiar"){
        #codigo para limpiar ultima entrada
        $conexion->query("DELETE FROM requisicion ORDER BY indice DESC LIMIT 1");
        header("Location:reportes.php? mensaje=Eliminado Correctamente");
        exit();
    }elseif($accion=="imprimir"){
        #codigo para imprimir requisiciones
        $imprimir = $conexion->query("SELECT Cantidad,Clave,Nombre,Precio FROM requisicion");
        #guardamos los datos de la tabla en un archivo.csv
        if($gestor = fopen('requisicion.csv','w')){
            while($fila = $imprimir->fetch_field()){
                $columnas[] = $fila->name;
            }
            fputcsv($gestor,$columnas);
            while($datos = $imprimir->fetch_assoc()){
                fputcsv($gestor,$datos);
            }
            fclose($gestor);
            echo shell_exec("$rutaexe $req");
            $sql = "TRUNCATE TABLE requisicion";
            #$conexion->query($sql);
            header("Location:reportes.php? mensaje=Requisicion Guardada");
            exit();
        }
    }elseif($accion=="cancelar"){
        #codigo para cancelar requisicion
        #instruccion para eliminar todos los datos de una tabla sin usar memoria
        $sql = "TRUNCATE TABLE requisicion";
        $conexion->query($sql);
        header("Location: reportes.php? mensaje=Requisicion Cancelada");
        exit();
    }
}
#cerrar conexion
$conexion->close();
?>