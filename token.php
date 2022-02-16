<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}


if(isset($_POST["bttoken"])){

    $codigo = $_POST["codigo"];
    $result1 = mysqli_query($conn, "SELECT * FROM snp_user WHERE usu_codigot = '$codigo'");
    $row1 = mysqli_num_rows($result1);
    

  if($row1 > 0){
      
    $otrasesion=$_SESSION['nombredelusuario'];
    $_SESSION['nombredelusuario2']=$otrasesion;
    echo
    "<script> alert('Código Correcto'); </script>";

    header('location: nuevaclave.php');
    exit();

  }else{
    echo
    "<script> alert('Código incorrecto'); </script>";
  }
}

?>


<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recuperación de Cuenta</title>
  </head>
  <body>
    <h2>Ingresar el código de recuperación para <?php print_r($_SESSION['nombredelusuario']); ?></h2>
    <form class="" action="" method="post" autocomplete="off">      
      <label for="codigo">Ingresa el Código: </label>
      <input type="text" name="codigo" id = "codigo" required value=""> <br>
      
      <button type="submit" name="bttoken">Aceptar</button>
    </form>
        
  </body>
</html>