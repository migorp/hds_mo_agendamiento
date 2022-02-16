<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index_usuario.php");
}

if(isset($_POST["submit"])){

  $email = $_POST["email"];
  $clave = $_POST["clave"];
  $result1 = mysqli_query($conn, "SELECT * FROM usuarios WHERE us_correo = '$email'");

  $row1 = mysqli_num_rows($result1);
  
  if($row1 > 0){

    $result2 = mysqli_query($conn, "SELECT * FROM usuarios WHERE us_clave = '$clave' AND us_correo = '$email'");

    $row2 = mysqli_num_rows($result2);

    if($row2 > 0){
      
      session_start();
      $_SESSION['id']= $email;
    
      $result3 = mysqli_query($conn, "SELECT US_APELLIDOSNOMBRES FROM usuarios WHERE us_correo = '$email'");
      $fetch_data = mysqli_fetch_assoc($result3);
      $row3 = $fetch_data['US_APELLIDOSNOMBRES'];
      $_SESSION['nombredelusuario'] = $row3;
      
      //$contador = "UPDATE usuarios SET usu_nacceso=usu_nacceso+1 WHERE usu_useremail='$email'";
      //mysqli_query($conn, $contador);
      
      header("Location: index_usuario.php");
    }
    else{
      echo
      "<script> alert('Contraseña Equivocada'); </script>";
    }
  }
  else{
    echo
    "<script> alert('Usuario no registrado o Email incorrecto'); </script>";
  }

}
?>


<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inicio de Sesión</title>

    <link rel="stylesheet" href="./moestilo.css">
  </head>
  <body>



  <!--
  <form method="POST">
    <table>
      <tr>
        <td colspan="3">  <h2>Muestra Finita</h2> </td>
      </tr>
      <tr>
        <td>Tamaño de la muestra</td>
        <td>(N) </td>
        <td><input type="text" name="fin_n" placeholder="Número entero sin , o ."></td>
      </tr>
      <tr>
        <td>Nivel de Confianza</td>
        <td>(Z) </td>
        <td><input type="text" name="fin_z" placeholder="Ejemplo: 1.96"></td>
      </tr>                    
    </table>
    <button type="submit" name="finita" >Calcular</button>
  </form>
  <tr>
      <td colspan="2">
      <h3> <label for="">La Muestra Finita es: </label> </h3></td>
  </tr>
-->










    <h2>Inicio de Sesión</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="usernameemail">Correo: </label>
      <input type="email" name="email" id = "email" required value=""> <br>
      <label for="password">Contraseña: </label>
      <input type="password" name="clave" id = "clave" required value=""> <br>
      <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="recover.php">Recuperar Clave</a>
    <p>
      <a href="registration.php">Registrar Nuevo Usuario</a>
    </p>
    
  </body>
</html>
