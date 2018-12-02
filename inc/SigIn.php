<?php
include_once "config.php";

$usuario = $_POST['sname'];
$clave = $_POST['spass'];
$correo = $_POST['semail'];


    if($usuario === '' || $clave === '' || $correo === ''){
      echo json_encode('error');
    }else{
        $existente = 'no';
        $conexion = mysqli_connect(SERVER, USER, PASS);
        $db = mysqli_select_db($conexion, DB ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
        $consulta = "SELECT * FROM Usuarios";
        $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        while ($columna = mysqli_fetch_array( $resultado ))
        {
            if($columna['nombre'] === $usuario || $columna['correo'] === $correo ){
                $existente = 'yes';
            }
        }

        if($existente === 'yes'){
            echo json_encode('existente');
        }else{
            $consulta = "INSERT INTO Usuarios (nombre, clave, correo) VALUES ('$usuario', '$clave', '$correo')";
            mysqli_query( $conexion, $consulta );
            echo json_encode('Usuario: '.$usuario.' was SignIn');
        }

        mysqli_close( $conexion );
    }
    
