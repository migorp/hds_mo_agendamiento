<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

if(isset($_POST["btrecuperar"])){

  $email = $_POST["email"];
  $result1 = mysqli_query($conn, "SELECT * FROM snp_user WHERE usu_useremail = '$email'");
  $row1 = mysqli_num_rows($result1);

  if($row1 > 0){

    $code = rand(999999, 111111);
    $tokentemporal = "UPDATE snp_user SET usu_codigot='$code' WHERE usu_useremail='$email'";
    $consulta= mysqli_query($conn, $tokentemporal);
    if($consulta){

      $mail = new PHPMailer(true);

      try {
          //Server settings
          //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->SMTPDebug = 0;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'mayerlymoyolema@gmail.com';                     //SMTP username
          $mail->Password   = 'Mayerly2017';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
          //$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

          //Recipients
          $mail->setFrom('Miguel@miguel.com', 'Webmaster del sitio');
          //$mail->addAddress('sq.miguelaop63@uniandes.edu.ec', 'Miguel Orellana');     //Add a recipient
          $mail->addAddress($email, $email);     //Add a recipient
          //$mail->addAddress('ellen@example.com');               //Name is optional
          //$mail->addReplyTo('info@example.com', 'Information');
          //$mail->addCC('cc@example.com');
          //$mail->addBCC('bcc@example.com');

          //Attachments
          //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
          //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Código de Reseteo de Contraseña de Usuario';
          $mail->Body    = 'Tu código temporal es '. $code; //<b>Úsalo!</b>';
          //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          //echo 'Mensaje enviado correctamente';

          $_SESSION['nombredelusuario']=$email;
          echo
          "<script> alert('Hemos enviado un correo a la dirección registrada, revisa tu bandeja de entrada'); </script>";
          
          header('location: token.php');
          exit();

      } catch (Exception $e) {
          echo "Mensaje no ha podido ser enviado. Mailer Error: {$mail->ErrorInfo}";
      }


     /*
      $titulo    = "Código de Reseteo de Contraseña de Usuario";
      $mensaje   = "Tu código temporal es $code";
      $remitente = "From: miguel@miguel.com";
      //mail($email, $titulo, $mensaje, $remitente);

      if(mail($email, $titulo, $mensaje, $remitente)){

        $_SESSION['nombredelusuario']=$email;
        echo
        "<script> alert('Hemos enviado un correo a la dirección registrada, revisa tu bandeja de entrada'); </script>";

        //$info = "We've sent a passwrod reset otp to your email - $email";
        //$_SESSION['info'] = $info;
        //$_SESSION['email'] = $email;
        header('location: token.php');
        exit();
      }
      */
    }
  }
  else{
    echo
    "<script> alert('Usuario no existe o Email incorrecto'); </script>";
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
    <h2>Recuperación de Cuenta</h2>
    <form class="" action="" method="post" autocomplete="off">      
      <label for="email">Ingresa el Correo: </label>
      <input type="email" name="email" id = "email" required value=""> <br>
      
      <button type="submit" name="btrecuperar">Recuperar Cuenta</button>
    </form>
    <br>
    <a href="login.php">Regresar a la página Principal</a>
  </body>
</html>