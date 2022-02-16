<?php
require 'config.php';


$usuario = $_SESSION['id'];
if (!isset($usuario)){
	header("location: login.php");
}else{
  
}

$usuario3 = $_SESSION['nombredelusuario'];



if(isset($_POST["btAgendar"])){
  
  //  if ($_POST['clave'] == $_POST['confirmclave']){

    //$usuario2 = $_SESSION['nombredelusuario'];
    $especialidad = $_POST['especialidad'];
    $fecha_agen = $_POST['fecha_agen'];
    $hora_agen = $_POST['hora_agen'];
    
         

      $sql5 = "SELECT US_ID FROM USUARIOS WHERE US_APELLIDOSNOMBRES='$usuario3';";
      $result22 = $conn->query($sql5);
      $res1 = mysqli_fetch_array($result22);
      $id_us = $res1[0];
      //echo $id_us;

          
        $guardaragenda = "INSERT INTO turnos (TUR_FECHA,TUR_HORA,TUR_DOC_ID,TUR_US_ID) 
            VALUES('$fecha_agen','$hora_agen','$especialidad','$id_us')";

      mysqli_query($conn, $guardaragenda);
      
      echo
      "<script> alert('Agendamiento Guardado Correctamente'); </script>";

    //}else{
     // echo
     // "<script> alert('Error al subir el archivo. No se pudo subir el archivo seleccionado'); </script>";
   // }
    
  //}
  //else{
  //  echo
  //  "<script> alert('Contraseñas no Coinciden'); </script>";
  //}
}

?>





<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="./moestilo.css">
  </head>
  <body>
    <h2>Panel de Agendamiento de citas</h2>

    <p>Bienvenido <?php print_r($_SESSION['nombredelusuario']); ?></p>
    <p> 
      <a href="logout.php">Salir</a>
    </p>
    

    <form class="" action="" method="post" enctype="multipart/form-data" autocomplete="off">

        <label for="">Especialidad:</label>
        <select name="especialidad">
            <option value="1">Pediatría</option>
            <option value="2">Ginecología</option>
            <option value="3">Medicina General</option>            
        </select>
        <br>

        <label for="">Fecha para agendamiento:</label> 
        <input type="date" id="fecha_agen" name="fecha_agen">
        <br>

        <label for="">Hora de agendamiento:</label>
        <input type="time" name="hora_agen">
        <br>

      <button type="submit" name="btAgendar">Guardar Nuevo Agendamiento</button>
    </form>
    <br>
    <br>

    <h2>Turnos Reservados</h2>
    <table>      
      <tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Especilidad</th>
      </tr>
      <?php
        //$conn = mysqli_connect("localhost", "root", "", "company");
        // Check connection
        //if ($conn->connect_error) {
        //die("Connection failed: " . $conn->connect_error);
        //}
        
        

        $sql2 = "SELECT TUR_FECHA, TUR_HORA, DOC_ESPECIALIDAD, US_APELLIDOSNOMBRES FROM TURNOS 
                  INNER JOIN DOCTORES ON TUR_DOC_ID = DOC_ID 
                  INNER JOIN USUARIOS ON TUR_US_ID = US_ID
                  where US_APELLIDOSNOMBRES = '$usuario3';";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["TUR_FECHA"]. "</td><td>" . $row["TUR_HORA"] . "</td><td>"
          . $row["DOC_ESPECIALIDAD"]. "</td></tr>";
          }
          echo "</table>";
        } else { echo "No hay agendamientos"; }
        $conn->close();
      ?>
    </table>


  </body>
</html>
