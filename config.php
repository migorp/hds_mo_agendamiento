<?php

session_start();

define('HOST', 'LOCALHOST');
define('USER', 'root');
define('PASS','');
define('BD','agendamiento');

$conn = mysqli_connect(HOST, USER, PASS, BD) or die ('Error de conexión');




?>