<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
?>
<!DOCTYPE html>
<html lang="en">
<?php cabecerahtml(); ?>
<body id="www-url-cz">
<?php 
    navbar();
    contenido();
    footer();
?>
