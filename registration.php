<?php

require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

if(isset($_POST["submit"])){

  if ($_POST['clave'] == $_POST['confirmclave']){

    $tempcorreo = $_POST['email'];

    $duplicate = mysqli_query($conn, "SELECT * FROM usuarios WHERE US_CORREO = '$tempcorreo'");
    if(mysqli_num_rows($duplicate) > 0){
      echo
      "<script> alert('Correo ya existe, ingrese otro correo por favor'); </script>";
    }
    else{

      $nombre = $_POST['nombre'];
      $cedula = $_POST['cedula'];
      $email = $_POST['email'];
      $clave = $_POST['clave'];
      $confirmclave = $_POST['confirmclave'];
      $telefono = $_POST['telefono'];
      $observacion = $_POST['observacion'];  
      //$nombre_base = basename($_FILES['archivo'][name]);
      //$nombre_final = date('m-d-y').'-'.date('H-i-s').'-'.$nombre_base;
      //$ruta = 'archivos/'. $nombre_final;
      
        //INSERT INTO `prueba1`(`id`, `nombre`) VALUES ('2',UPPER('juas'))
        $query = "INSERT INTO usuarios (US_APELLIDOSNOMBRES,US_CEDULA,US_MOVIL,US_CLAVE,US_CORREO,US_OBSERVACIONES) 
                VALUES(UPPER('$nombre'),'$cedula','$telefono','$clave','$email',UPPER('$observacion'))";
        mysqli_query($conn, $query);

      echo
      "<script> alert('Registro Exitoso'); </script>";

      
      
    }
    
  }
  else{
    echo
    "<script> alert('Contraseñas no Coinciden'); </script>";
  }

}




/*
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

if(isset($_POST["submit"])){

  if ($_POST['clave'] == $_POST['confirmclave']){

    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $confirmclave = $_POST['confirmclave'];
    $telefono = $_POST['telefono'];
    $observacion = $_POST['observacion'];  
    $avatar_path = ('imagen/'.$_FILES['avatar']['name']);
  
    if(copy($_FILES['avatar']['name'], $avatar_path)){
  
      $_SESSION['nombre'] = $nombre;
      $_SESSION['avatar'] = $avatar_path;
  
      $query = "INSERT INTO snp_user (USU_FOTO,USU_APNO,USU_CEDULA,USU_MOVIL,USU_TIPO,USU_CLAV,USU_USEREMAIL,USU_ACTIVO,USU_OBSERVACION,USU_NACCESO) 
                  VALUES('$avatar','$nombre','$cedula','$telefono','7','$clave','$email','2','$observacion','1')";
                  mysqli_query($conn, $query);
      
      if($query== true){
        $_SESSION['message'] = 'Registro Existoso! agregado $nombre a la base de datos';
        header("location: index.php");
      }
      else{
        $_SESSION['message'] = 'Usuario no puede ser agregado a la base de datos';
      }   
  
    }
    else{
      $_SESSION['message'] = 'no se pudo subir imagen a la base de datos';
    }
  
  }  

}
*/

 
  

/*
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}


if(isset($_POST['moveFile']))
{
  $fileName = $_FILES['fileName']['name'];
  $tempName = $_FILES['fileName']['tmp_name'];
  
  
  if(isset($fileName))
  {
      if(!empty($fileName))
      {
          $location = "MisArchivos/";
          if(move_uploaded_file($tempName, $location.$fileName))
          {
              echo 'Archivo Subido con éxito';
          }
      }
  }
}


if(isset($_POST["submit"])){
  
  $nombre = $_POST["nombre"];
  $cedula = $_POST["cedula"];
  $email = $_POST["email"];
  $clave = $_POST["clave"];
  $confirmclave = $_POST["confirmclave"];
  $telefono = $_POST["telefono"];
  $observacion = $_POST["observacion"];

  $avatar = $_POST["avatar"];
    
  $duplicate = mysqli_query($conn, "SELECT * FROM snp_user WHERE usu_useremail = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Correo ya existe'); </script>";
  }
  else{
    if($clave == $confirmclave){
      $query = "INSERT INTO snp_user (USU_FOTO,USU_APNO,USU_CEDULA,USU_MOVIL,USU_TIPO,USU_CLAV,USU_USEREMAIL,USU_ACTIVO,USU_OBSERVACION,USU_NACCESO) 
                VALUES('$avatar','$nombre','$cedula','$telefono','7','$clave','$email','2','$observacion','1')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registro Exitoso'); </script>";
    }
    else{
      echo
      "<script> alert('Contraseña no Coincide'); </script>";
    }
  }

}
*/

?>


<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="./moestilo.css">
  </head>
  <body>
    <h2>Formulario de Registro de Usuarios</h2>
    <form class="" action="" method="post" enctype="multipart/form-data" autocomplete="off">
      <label for="nombre">Apellidos y Nombres: </label>
      <input type="text" name="nombre" id = "nombre" required value="" style="text-transform:uppercase"> <br>
      <label for="cedula">Cédula: </label>
      <input type="text" name="cedula" id = "cedula" required value="" pattern=".{10,}" required title="Cédula 10 dígitos" maxlength="10" onkeypress='return event.charCode>=48 &&event.charCode<=57'> <br>
      <label for="email">Correo: </label>
      <input type="email" name="email" id = "email" required value=""> <br>
      <label for="clave">Contraseña: </label>
      <input type="password" name="clave" id = "clave" required value=""> <br>
      <label for="confirmclave">Repetir Contraseña: </label>
      <input type="password" name="confirmclave" id = "confirmclave" required value=""> <br>

      <label for="telefono">Teléfono: </label>
      <input type="text" name="telefono" id = "telefono" required value="" pattern=".{10,}" required title="Teléfono debe tener 10 dígitos" maxlength="10" onkeypress='return event.charCode>=48 &&event.charCode<=57'> <br>
      <label for="observacion">Observación: </label>
      <input type="text" name="observacion" id = "observacion" required value="" style="text-transform:uppercase"> <br>
      
      <button type="submit" name="submit">Registrar</button>
    </form>
    <br>
    <a href="login.php">Iniciar Sesión</a>
  </body>
</html>
