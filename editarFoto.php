<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
    $foto = borrarFoto();
    editarFoto();
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

    <form action="editarFoto.php" method="GET">
        <input type="hidden" name="foto" value="<?php echo $foto[0]["id"];?>">
        <label for="titulo">Titulo: </label></br>
        <input type="text" id="titulo" name="titulo" value="<?php echo $foto[0]["titulo"]; ?>" ></br></br>
        <label for="descripcion">Contenido: </label></br>
        <textarea name="descripcion" id="descripcion" rows="10" cols="80"><?php echo $foto[0]["descripcion"]; ?></textarea>
        </br></br>
        <input type="submit" name="guardar" value="Guardar">
    </form>
</div>
</div>
</div>
<?php
    footer();
?>
