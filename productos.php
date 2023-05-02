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

$conexion = getConexion();

if (isset($_POST["operacion"])) {
  if ($_POST["operacion"] == "listar") {
    $consulta = $conexion->prepare("SELECT * FROM productos");
    $consulta->execute();
    $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datosObtenidos);
  }
  
  if ($_POST["operacion"] == "registrar") {
    $repuesta = [
      "status" => false,
      "message" => ""
    ];

    try {
      $consulta = $conexion->prepare("INSERT INTO productos(nombre, marca, precio) VALUES (?,?,?)");
      $repuesta["status"] = $consulta->execute(
        array(
          $_POST["nombre"],
          $_POST["marca"],
          $_POST["precio"]
        )
      );

    } catch (Exception $e) {
      /* die($e->getMessage()); */
      //El objeto $e tiene los siguientes metodos
      //getcode() - getFile() - getMessage() - getLine(), getPrevious() - getTraceAsString()
      $repuesta["message"] = "No se completo el proceso codigo de error: " . $e->getCode();
    }

    echo json_encode($repuesta);
  }

  if($_POST["operacion"] == "eliminar"){
    $respuesta = [
      "status" => false,
      "message" => ""
    ];

    try{
      $consulta = $conexion->prepare("DELETE FROM productos WHERE idproducto = ?");
      $respuesta["status"] = $consulta->execute(array($_POST["idproducto"]));
    }catch(Exception $e){
      $repuesta["message"] = "no se pudo eliminar"; 
    }

    echo json_encode($respuesta);
  }

  if($_POST["operacion"] == "obtener"){
    $respuesta = [
      "status" => false,
      "data" => []
    ];

    try {
      $consulta = $conexion->prepare("SELECT * from productos WHERE idproducto = ?");
      $consulta->execute(array($_POST["idproducto"]));
      $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
      $respuesta["data"] = $resultado;
      $respuesta["status"] = true;
    } catch (Exception $e) {
      die($e->getMessage());
    }

    echo json_encode($respuesta);
  }

 if($_POST["operacion"] == "editar"){
  $repuesta = [
    "status" => false,
    "message" => ""
  ];

  try{
   $consulta = $conexion->prepare("UPDATE productos SET nombre = ? , marca = ?, precio = ? , update_at = NOW()  WHERE idproducto = ?");
    $repuesta["status"] = $consulta->execute(
      array(
        $_POST["nombre"],
        $_POST["marca"],
        $_POST["precio"],
        $_POST["idproducto"]
      )
    );
    
  }catch(Exception $e){
    $repuesta["message"] = "Error al editar,  Me muero !!!!!!!!!!!!!!!! ❌";
  }
  echo json_encode($repuesta);
 }
}