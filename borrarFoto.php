<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
    $foto = borrarFoto();
?>
<!DOCTYPE html>
<html lang="en">
<?php cabecerahtml(); 
?>
<?php 
    navbar();
    borrarPost();
?>
<div id="page" class="box">
<div id="page-in" class="box">
<div id="content">
    <p>Estás seguro de que quieres borrar el artículo <strong><?php echo $foto[0]["titulo"];?></strong></p>
        </br>
        </br>
    <button><a href="borrarFoto.php?foto=<?php echo $foto[0]["id"];?>&borrar=1">Borrar</a></button>
    <button><a href="fotos.php">Cancelar</a></button>
</div>
</div>
</div>
<?php
    footer();
?>
