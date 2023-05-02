<?php

function getConexion()
{
  try {
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dbajax;charset=UTF8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (Exception $e) {
    die($e->getMessage());
  }
}

date_default_timezone_set('America/Lima');
$conexion = getConexion();


if(isset($_POST["operacion"])){
  if($_POST["operacion"] == "registrar"){
    $respuesta = [
      "status" => false,
      "message" => "",
    ];

    // enviaremos datos de la tabla + upload binario
    try {
        $nombreArchivo = '';
        $rutaDestino = '';
        $nombreGuardar = null;
      // PASO1: subir el archivo
      if(isset($_FILES["fotografia"])){
        //ruta
        $rutaDestino = './img/personas/';
        //nombre del archivo
        $nombreArchivo = sha1(date('c')) . ".jpg";
        // ruta completo
        $rutaDestino .= $nombreArchivo;

        if(move_uploaded_file($_FILES["fotografia"]["tmp_name"], $rutaDestino)){
          $nombreGuardar = $nombreArchivo;
        }
      } 


      $consulta = $conexion->prepare("INSERT INTO personas(apellidos, nombres, fotografia) VALUES (?,?,?)");
      $respuesta["status"] = $consulta->execute(
        array(
          $_POST["apellidos"],
          $_POST["nombres"],
          $nombreGuardar
          )
        );

    } catch (Exception $e) {
      $respuesta["message"] = "no se pudo registrar";
    }

    echo json_encode($respuesta);
  }
}