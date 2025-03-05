<?php
    require_once("./plantillas/plantilla.inc.php");
    require_once("./plantillas/session.inc.php");
    inciarSesion();
    $usuario = editarUsuario();
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
<div>
    <form action="editarUsuario.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
        <table style="border:solid 1px collapse; width: 130%; table-layout: fixed;">
        <tr>
            <th>LOGIN</th>
            <th>ROL</th>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>EDAD</th>
            <th>LOCALIDAD</th>

        </tr>
    <?php 
        for ($x = 0; $x < count($usuario); $x++) {
            echo "
            <tr>
                <td><input type='text' name='login' value='" .$usuario[$x]["login"]. "' style='width: 95%;'></td>
                <td><input type='text' name='rol' value='" .$usuario[$x]["rol"]. "' style='width: 95%;'></td>
                <td><input type='text' name='nombre' value='" .$usuario[$x]["nombre"]. "' style='width: 95%;'></td>
                <td><input type='text' name='apellidos' value='" .$usuario[$x]["apellidos"]. "' style='width: 95%;'></td>
                <td><input type='text' name='edad' value='" .$usuario[$x]["edad"]. "' style='width: 95%;'></td>
                <td><input type='text' name='localidad' value='" .$usuario[$x]["localidad"]. "' style='width: 95%;'></td>
            </tr>";
        }
    ?>    
    </table>
        <input type="submit" name="guardar" value="Guardar">
    </form>
</div>
</div>
</div>
</div>
<?php
    footer();
?>
