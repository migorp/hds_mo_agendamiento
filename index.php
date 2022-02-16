<?php
require 'config.php';


$usuario = $_SESSION['id'];
if (!isset($usuario)){
	header("location: login.php");
}else{
  
}



if(isset($_POST["btActualizar"])){
  if ($_POST['clave'] == $_POST['confirmclave']){

    $usuario2 = $_SESSION['nombredelusuario'];
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $clave = $_POST['clave'];
    $confirmclave = $_POST['confirmclave'];
    $telefono = $_POST['telefono'];
    $observacion = $_POST['observacion'];  

    $avatarruta = ('imagen/'.$_FILES['avatar']['name']);
    
    $subirarchivo = move_uploaded_file($_FILES['avatar']['tmp_name'],$avatarruta);

    if($subirarchivo){

      $_SESSION['nombredelusuario']=$nombre;

      // UPDATE snp_user SET usu_apno="Qwe", usu_cedula="456" where usu_useremail="qwe@qwe.qwe"
      $actualizar = "UPDATE snp_user SET USU_FOTO='$avatarruta', USU_APNO=UPPER('$nombre'),USU_CEDULA='$cedula',USU_MOVIL='$telefono',
                    USU_CLAV='$clave', USU_OBSERVACION=UPPER('$observacion') WHERE USU_APNO='$usuario2'";
      mysqli_query($conn, $actualizar);
      
      echo
      "<script> alert('Datos Actualizados Correctamente'); </script>";

    }else{
      echo
      "<script> alert('Error al subir el archivo. No se pudo subir el archivo seleccionado'); </script>";
    }
    
  }
  else{
    echo
    "<script> alert('Contraseñas no Coinciden'); </script>";
  }
}

?>





<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panel de Usuario</title>
  </head>
  <body>
    <h2>Panel de Usuario</h2>

    <p>Bienvenido <?php print_r($_SESSION['nombredelusuario']); ?></p>
    <p> 
      <a href="logout.php">Salir</a>
    </p>
    

    <form class="" action="" method="post" enctype="multipart/form-data" autocomplete="off">

      <?php         

        $usuario2 = $_SESSION['nombredelusuario'];
        //print_r($usuario2);
        $sql1 = mysqli_query($conn, "SELECT US_APELLIDOSNOMBRES,US_CEDULA,US_MOVIL,US_CLAVE,US_OBSERVACIONES,US_CORREO FROM usuarios WHERE US_APELLIDOSNOMBRES = '$usuario2'"); 
        $rowss2 = mysqli_fetch_assoc($sql1);
        //print_r($rowss2['USU_APNO']); 
      ?>

        
      <label for="nombre">Nombre y Apellido:   </label>
      <input type="text" name="nombre" id = "nombre" required value="<?php echo $rowss2['US_APELLIDOSNOMBRES']?>" style="text-transform:uppercase"> <br>
      <label for="cedula">Cédula: </label>
      <input type="text" name="cedula" id = "cedula" required value="<?php echo $rowss2['US_CEDULA']?>"  pattern=".{10,}" required title="Cédula 10 dígitos" maxlength="10" onkeypress='return event.charCode>=48 &&event.charCode<=57'> <br>
      <label for="email">Correo: </label>
      <input type="email" name="email" id = "email" required value="<?php echo $rowss2['US_CORREO']?>" disabled> <br>
      <label for="clave">Contraseña: </label>
      <input type="password" name="clave" id = "clave" required value="<?php echo $rowss2['US_CLAVE']?>"> <br>
      <label for="confirmclave">Repetir Contraseña: </label>
      <input type="password" name="confirmclave" id = "confirmclave" required value="<?php echo $rowss2['US_CLAVE']?>"> <br>

      <label for="telefono">Teléfono: </label>
      <input type="text" name="telefono" id = "telefono" required value="<?php echo $rowss2['US_MOVIL']?>" pattern=".{10,}" required title="Teléfono debe tener 10 dígitos" maxlength="10" onkeypress='return event.charCode>=48 &&event.charCode<=57'> <br>
      <label for="observacion">Observación: </label>
      <input type="text" name="observacion" id = "observacion" required value="<?php echo $rowss2['US_OBSERVACIONES']?>" style="text-transform:uppercase"> <br>
      
      
      <!--
      <div class="avatar">
	      <label>Subir Imagen: </label>
	      <input type="file" name="avatar" accept="image/*" required />
      </div>
      -->

      <button type="submit" name="btActualizar">Actualizar datos</button>
    </form>
    <br>

  </body>
</html>
