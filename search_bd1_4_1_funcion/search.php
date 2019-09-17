<?php

function consulta($busqueda) {
    require("conec.php");

//conección de base de datos por procedimientos.
    $conexion = mysqli_connect($db_host, $db_usuario, $db_pass);

    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la BBDD";
        exit();
    }
//conectarnos a la base de datos.
    mysqli_select_db($conexion, $db_nombre) or die("no se encuentra la BBDD");
    mysqli_set_charset($conexion, "utf8");
//$consulta="select * from datospersonales where nombre like 'María%' ";
    $consulta = "select * from datospersonales where nombre like '%$busqueda%' ";
    $resultado = mysqli_query($conexion, $consulta);
  
    if(mysqli_fetch_array($resultado, MYSQLI_ASSOC )== null){
        echo "no existen datos";
    }

//cuandp acceda a un registro que no existe no se ejecuta sera igual a false
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        echo "<table width='50%' align='center' align='center' border='1'> <tr><td>";
        //NOMBRES DE LOS CAMPOS DE LA TABLA
        echo $fila['NIF'] . " " . $fila['NOMBRE'] . " " . $fila['APELLIDO'] . " " . $fila['EDAD'];
        echo "<br>";
        echo "<br>";
        echo "</td></tr></table>";
    }
  
    mysqli_close($conexion);
}

?>
