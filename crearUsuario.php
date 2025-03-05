<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
    crearUsuario();
?>
<!DOCTYPE html>
<html lang="en">
<?php cabecerahtml(); 
?>
<?php 
    navbar();
?>
<div id="page" class="box">
<div id="page-in" class="box">
<div id="content">
    <form action="crearUsuario.php" method="GET">
        <label for="login">Login: </label></br>
        <input type="text" id="login" name="login"></br></br>
        <label for="password">Password: </label></br>
        <input type="password" id="password" name="password"></br></br>
        <label for="rol">Rol: </label></br>
        <input type="text" id="rol" name="rol"></br></br>
        <label for="nombre">Nombre: </label></br>
        <input type="text" id="nombre" name="nombre"></br></br>
        <label for="apellidos">Apellidos: </label></br>
        <input type="text" id="apellidos" name="apellidos"></br></br>
        <label for="edad">Edad: </label></br>
        <input type="number" id="edad" name="edad"></br></br>
        <label for="localidad">Localidad: </label></br>
        <input type="text" id="localidad" name="localidad"></br></br>
        <input type="submit" name="guardar" value="Guardar">
    </form>
</div>
</div>
</div>
<?php
    footer();
?>
