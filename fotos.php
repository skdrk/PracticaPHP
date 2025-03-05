<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
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
        <!-- Content -->
        <div id="content">
        <?php $fotos = getFotos(); ?>
            <!-- Article -->

                <?php 
                for ($x = 0; $x < count($fotos); $x++) {
                    echo '<div class="article">';
                    echo "<h2><span><a href='#'>" . $fotos[$x]['titulo'] . "</a></span></h2>";
                    echo "<p class='info noprint'>
                    <span class='comments'><a href='#'>Comments</a></span>
                    </p>";
                    echo "<p>" . $fotos[$x]['descripcion'] . "</p>";
                    echo "<img src=" . $fotos[$x]['imagen'] . " width='150' height=''>";
                    echo "<div style='display: flex; justify-content: flex-start; gap: 100px; margin-left: 5.5rem;'>";
                    if ($_SESSION["rol"] == "admin") {
                        echo "<p class='btn-more box'><strong><a href='editarFoto.php?foto=" . $fotos[$x]["id"] . "'>Editar</a></strong></p>";
                        echo "<p class='btn-more box'><strong><a href='borrarFoto.php?foto=" . $fotos[$x]["id"] . "'>Borrar</a></strong></p>";
                    }
                    echo "</div>";                    
                    echo '</div> <!-- /article -->';
                    echo '<hr class="noscreen" />';
                }
                
                ?>
        </div> <!-- /content -->
</div>
</div>
<?php
    footer();
?>
