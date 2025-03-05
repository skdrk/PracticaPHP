<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
?>
<?php $artigos = editarArticulo(); ?>
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
    <p>Estás seguro de que quieres borrar el artículo <strong><?php echo $artigos[0]["titulo"];?></strong></p>
        </br>
        </br>
    <button><a href="borrarPost.php?artigo=<?php echo $artigos[0]["id"];?>&borrar=1&categoria=<?php echo $artigos[0]["subcategoria"];?>">Borrar</a></button>
    <button><a href="index.php?categoria=<?php echo $artigos[0]["subcategoria"];?>">Cancelar</a></button>
</div>
</div>
</div>
<?php
    footer();
?>
