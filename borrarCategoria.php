<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
    $categorias = getCategorias();
    borrarCategoria();
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
    <form action="borrarCategoria.php" method="GET">
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
            <option disabled selected value> -- select an option -- </option>
                    <?php 
                        for ($x = 0; $x < count($categorias); $x++) {
                            if ($x == 0 || $categorias[$x]["categoria"] != $categorias[$x - 1]["categoria"]) {
                                echo "</optgroup>";
                                echo "<option value='" . $categorias[$x]["categoria"] . "'>" . $categorias[$x]["categoria"] . "</option>";
                            }
                        }
                    ?>
        </select>
        </br></br>
        <label for="subcategoria">Subcategoria</label>
        <select name="subcategoria" id="subcategoria">
            <option disabled selected value> -- select an option -- </option>
                    <?php 
                        for ($x = 0; $x < count($categorias); $x++) {
                            echo "<option value='" . $categorias[$x]["subcategoria"] ."'>" . $categorias[$x]["subcategoria"] . "</option>";
                        }
                    ?>
        </select></br></br>
        <input type="submit" name="borrar" value="Borrar">
    </form>
</div>
</div>
</div>
<?php
    footer();
?>
