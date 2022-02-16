<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

if(isset($_POST["btnuevac"])){
    if ($_POST['clave'] == $_POST['confirmclave']){


        $vartemp = $_SESSION['nombredelusuario2'];
        $duplicate2 = mysqli_query($conn, "SELECT * FROM snp_user WHERE usu_useremail = '$vartemp'");
        if(mysqli_num_rows($duplicate2) > 0){
            $clave = $_POST['clave'];
            $nuevaclav = "UPDATE snp_user SET USU_CLAV='$clave',usu_codigot='0' WHERE usu_useremail='$vartemp'";
            mysqli_query($conn, $nuevaclav);

            echo
            "<script> alert('Su clave ha sido cambiada con éxito'); </script>";

            header("Location: index.php");
            exit();

        }


        


    }else{
    echo
    "<script> alert('Contraseñas no Coinciden'); </script>";
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
    <h2>Ingrese la nueva contraseña</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="clave">Contraseña: </label>
      <input type="password" name="clave" id = "clave" required value=""> <br>
      <label for="confirmclave">Repetir Contraseña: </label>
      <input type="password" name="confirmclave" id = "confirmclave" required value=""> <br>
      
      <button type="submit" name="btnuevac">Aceptar</button>
    </form>
        
  </body>
</html>