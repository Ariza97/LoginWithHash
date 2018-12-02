<?php
include_once "config.php";

$clave = $_POST['spass'];
$correo = $_POST['semail'];

    if($clave === '' || $correo === ''){
        echo json_encode('error');
    }else{
        $existente = 'no';
        $conexion = mysqli_connect(SERVER, USER, PASS);
        $db = mysqli_select_db($conexion, DB ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
        $consulta = "SELECT * FROM Usuarios";
        $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        while ($columna = mysqli_fetch_array( $resultado ))
        {
            if($columna['correo'] === $correo ){
                $existente = 'yes';
            }
        }

        if($existente === 'yes'){
            $consulta = "UPDATE Usuarios SET clave= '$clave' WHERE correo = '$correo';";
            mysqli_query( $conexion, $consulta );
            echo json_encode('The password was updated');
        }else{
            echo json_encode('no_existente');
        }

        mysqli_close( $conexion );
    }