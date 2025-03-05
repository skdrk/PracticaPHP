<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
?>
<?php 
borrarUsuario();
$usuario = editarUsuario(); ?>
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
    <p>Estás seguro de que quieres borrar el usuario <strong><?php echo $usuario[0]["login"];?></strong></p>
        </br>
        </br>
    <button><a href="borrarUsuario.php?id=<?php echo $usuario[0]["id"];?>&borrar=<?php echo $usuario[0]["id"];?>">Borrar</a></button>
    <button><a href="usuarios.php">Cancelar</a></button>
</div>
</div>
</div>
<?php
    footer();
?>
