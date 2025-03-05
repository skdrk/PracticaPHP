<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    comprobarUsuario();
    $usuarios = inforUsuarios();
?>
<!DOCTYPE html>
<html lang="en">
<?php cabecerahtml(); ?>
<body id="www-url-cz">
<?php 
    navbar();
?>
<div id="page" class="box">
<div id="page-in" class="box">
<div id="content">
    <button><a href='crearUsuario.php'>Crear usuario</a></button>
    <table style="border:solid 1px collapse;">
        <tr>
            <th>LOGIN</th>
            <th>ROL</th>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>EDAD</th>
            <th>LOCALIDAD</th>
            <th></th>
            <th></th>
        </tr>
    <?php 
        for ($x = 0; $x < count($usuarios); $x++) {
            echo "
            <tr>
                <td>" .$usuarios[$x]["login"]. "</td>
                <td>" .$usuarios[$x]["rol"]. "</td>
                <td>" .$usuarios[$x]["nombre"]. "</td>
                <td>" .$usuarios[$x]["apellidos"]. "</td>
                <td>" .$usuarios[$x]["edad"]. "</td>
                <td>" .$usuarios[$x]["localidad"]. "</td>
                <td>
                    <button><a href='editarUsuario.php?id=" .$usuarios[$x]["id"]. "'>Editar</a></button>
                </td>
                <td><button><a href='borrarUsuario.php?id=" .$usuarios[$x]["id"]. "'>Borrar</a></button></td>
                
            </tr>";
        }
    ?>    
    </table>
    <?php ?>
</div>
</div>
</div>
<?php
    footer();
?>
