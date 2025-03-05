<?php 
        session_start();
        require_once "plantillas/session.inc.php";
            //Marcar en la DB que ya NO está online
            $mysqli = getConnection();
            $login = $_SESSION["usuario"];
            $stmt = $mysqli->prepare("UPDATE usuarios SET online = 0 WHERE login = '$login'");
            $stmt->execute();
        finalizarSesion();
        header("Location: ./login.php");
        die();
?>