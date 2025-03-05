<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
    crearPost();
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

    <form action="crearPost.php" method="GET">
        <label for="titulo">Titulo: </label></br>
        <input type="text" id="titulo" name="titulo"></br></br>
        <label for="contenido">Contenido: </label></br>
        <textarea name="contenido" id="contenido" rows="10" cols="80"></textarea>
        </br></br>
        <label for="categoria">Elige la categoria: </label>
        <select name="categoria" id="categoria">
            <?php 
                $categorias = getCategorias();
                for ($x = 0; $x < count($categorias); $x++) {
                    if ($x == 0 || $categorias[$x]["categoria"] != $categorias[$x - 1]["categoria"]) {
                        echo "</optgroup>";
                        echo "<optgroup label='" . $categorias[$x]["categoria"] . "'>";
                    }
                    echo "<option value='" . $categorias[$x]["subcategoria"] ."' ";
                    if ($categorias[0]["subcategoria"] == $categorias[$x]["subcategoria"]) {echo "selected";}
                    echo ">" . $categorias[$x]["subcategoria"] . "</option>";
                }
            ?>
        </select> 
            </br>
            </br>
        <input type="submit" name="guardar" value="Guardar">
    </form>
</div>
</div>
</div>
<?php
    footer();
?>
