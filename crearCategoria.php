<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
    crearCategoria();
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

    <form action="crearCategoria.php" method="GET">
        <label for="categoria">Categoria: </label></br>
        <input type="text" id="categoria" name="categoria"></br ></br>
        <label for="categoriaPadre">Elige la categoria padre: </label>
        <select name="categoriaPadre" id="categoriaPadre">
            <?php 
                $categorias = getCategorias();
                for ($x = 0; $x < count($categorias); $x++) {
                    if ($x == 0 || $categorias[$x]["categoria"] != $categorias[$x - 1]["categoria"]) {
                        echo "<option value='" . $categorias[$x]["categoria"] . "'>" . $categorias[$x]["categoria"] . "</option>";
                    }
                }
            ?>
        </select> 
            </br>
            </br>
        <label for="subcategoria">Subcategoria: </label></br>
        <input type="text" id="subcategoria" name="subcategoria"></br></br>
        <input type="submit" name="guardar" value="Guardar">
    </form>
</div>
</div>
</div>
<?php
    footer();
?>
