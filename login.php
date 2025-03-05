<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
?>
<!DOCTYPE html>
<html lang="en">
<?php cabecerahtml(); ?>
<body id="www-url-cz">
<?php 
    navbar();
    getUser();
?>
<div style="margin-top: 20px;">
<form action="login.php" method="GET">
    <label for="usuario">Usuario: </label>
    <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario..." required></br>
    <label for="password">Password: </label>
    <input type="password" id="password" name="password" placeholder="Contraseña..." requiered></br>
    <input type="submit" name="login" value="Enviar">
</form>    
</div>
<?php
    footer();
?>
