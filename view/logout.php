<?php
@session_start(); //to ensure you are using same session
@session_destroy(); //destroy the session
unset($_SESSION['tipoUsuario']);
unset($_SESSION['email']);
unset($_SESSION['id']);
@header("location: /"); //to redirect back to "index.php" after logging out
exit();
?>