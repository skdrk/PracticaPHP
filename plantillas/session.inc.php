<?php
function inciarSesion() {
    if (!isset($_SESSION)) {
        session_start();
    }    
}

function finalizarSesion() {
    $_SESSION = array();
    //Si se desea destruir la sesión completamente, borrar la cookie de sesión.
    //Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (INI_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
    );
    }
    // Finalmente, destruir la sesión.
    session_destroy();
}

//VERIFICAR QUE ESTÁ LA SESIÓN INICIADA.
function comprobarUsuario() {
    //CATEGORIA DEFAULT
    if (!isset($_GET["categoria"])) {
        $_GET["categoria"] = "Windows";
    }
    if (!isset($_SESSION["usuario"])) {
        header ("Location: ./login.php");
    }
}

//CONEXIÓN A LA BASE DE DATOS
function getConnection() {
    $mysqli = new mysqli("localhost", "root", "", "iaweb");
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    return $mysqli;
}

//COMPROBAR INICIO DE SESIÓN | logearse
function getUser() {
    $mysqli = getConnection();
    if (isset($_GET["login"])) {
        $login = $_GET["usuario"];
        $password = $_GET["password"];
        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE login = ? AND password = ?");
        $stmt->bind_param('ss', $login, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $check = $result->fetch_all(MYSQLI_ASSOC);
        if (count($check) != 0) {
            //CONTADOR DE INICIOS DE SESIÓN
            if (!isset($_COOKIE["contador"])) {
                setcookie("contador", 1);
            } else {
                $contador = $_COOKIE["contador"];
                setcookie("contador", 1 + $contador);
            }
            //Marcar en la DB que está online
            $stmt = $mysqli->prepare("UPDATE usuarios SET online = 1 WHERE login = '$login'");
            $stmt->execute();

            $_SESSION["usuario"] = $check[0]["login"];
            $_SESSION["nombre"] = $check[0]["nombre"] . " " . $check[0]["apellidos"];
            $_SESSION["localidad"] = $check[0]["localidad"];
            $_SESSION["edad"] = $check[0]["edad"];
            $_SESSION["rol"] = $check[0]["rol"];
            header("Location: ./index.php");
        }
    }
}

function getCategorias() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM cat_subcat ORDER BY categoria");
    $stmt->execute();
    $result = $stmt->get_result();
    $categorias = $result->fetch_all(MYSQLI_ASSOC);
    return $categorias;
}

function getArticulos() {
    $mysqli = getConnection();
    $subcategoria = $_GET["categoria"];
    $stmt = $mysqli->prepare("SELECT * FROM artigo WHERE subcategoria = ?");
    $stmt->bind_param('s', $subcategoria);
    $stmt->execute();
    $result = $stmt->get_result();
    $artigos = $result->fetch_all(MYSQLI_ASSOC);
    return $artigos;
}

function editarArticulo() {
    $mysqli = getConnection();
    $artigo = $_GET["artigo"];
    if (isset($_GET["guardar"])) {
        $titulo = $_GET["titulo"];
        $contenido = $_GET["contenido"];
        $subcategoria = $_GET["categoria"];
        $stmt = $mysqli->prepare("UPDATE artigo SET titulo = ?, contido = ?, subcategoria = ? WHERE id = ?");
        $stmt->bind_param('sssi', $titulo, $contenido, $subcategoria, $artigo);
        $stmt->execute();
        header("Location: ./index.php?categoria=$subcategoria");
    } else {
        $stmt = $mysqli->prepare("SELECT * FROM artigo WHERE id = ?");
        $stmt->bind_param('i', $artigo);
        $stmt->execute();
        $result = $stmt->get_result();
        $artigos = $result->fetch_all(MYSQLI_ASSOC);
        return $artigos;
    }

}

function borrarPost() {
    if (isset($_GET["borrar"])) {
        $subcategoria = $_GET["categoria"];
        $mysqli = getConnection();
        $artigo = $_GET["artigo"];
        $stmt = $mysqli->prepare("DELETE FROM artigo WHERE id = ?");
        $stmt->bind_param('i', $artigo);
        $stmt->execute();
        header("Location: ./index.php?categoria=$subcategoria");
    }
}

function crearPost() {
    //En este tipo de funciones muy importante fijarse en la estructura de la consulta SQL...
    //En este caso en concreto la fecha causaba problemas...
    if (isset($_GET["guardar"])) {
        $titulo = $_GET["titulo"];
        $contenido = $_GET["contenido"];
        $subcategoria = $_GET["categoria"];
        $autor = $_SESSION["usuario"];
        $mysqli = getConnection();
        $stmt = $mysqli->prepare("INSERT INTO artigo (autor, titulo, contido, data, subcategoria) VALUES (?, ?, ?, CURRENT_DATE, ?)");
        $stmt->bind_param('ssss', $autor, $titulo, $contenido, $subcategoria);
        $stmt->execute();
        header("Location: ./index.php?categoria=$subcategoria");
    }
}

function crearCategoria() {
    if (isset($_GET["guardar"])) {
        $mysqli = getConnection();
        if ($_GET["categoria"] == "") {
            $categoriaPadre = $_GET["categoriaPadre"];
            $subcategoria = $_GET["subcategoria"];
            $stmt = $mysqli->prepare("INSERT INTO cat_subcat (categoria, subcategoria) VALUES (?, ?)");
            $stmt->bind_param('ss', $categoriaPadre, $subcategoria);
        } else {
            $categoria = $_GET["categoria"];
            $subcategoria = $_GET["subcategoria"];
            $stmt = $mysqli->prepare("INSERT INTO cat_subcat (categoria, subcategoria) VALUES (?, ?)");
            $stmt->bind_param('ss', $categoria, $subcategoria);
        }
        $stmt->execute();
        header("Location: ./index.php?categoria=$subcategoria");
    }
}

function inforUsuarios() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    $result = $stmt->get_result();
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
    return $usuarios;
}

function borrarUsuario() {
    if (isset($_GET["borrar"])) {
        $mysqli = getConnection();
        $id = $_GET["id"];
        $stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        header("Location: ./usuarios.php");
    }
}

function editarUsuario() {
    $mysqli = getConnection();
    $id = $_GET["id"];
    if (isset($_GET["guardar"])) {
        $login = $_GET["login"];
        $nombre = $_GET["nombre"];
        $apellidos = $_GET["apellidos"];
        $edad = $_GET["edad"];
        $localidad = $_GET["localidad"];
        $stmt = $mysqli->prepare("UPDATE usuarios SET login = ?, nombre = ?, apellidos = ?, edad = ?, localidad = ? WHERE id = ?");
        $stmt->bind_param('sssisi', $login, $nombre, $apellidos, $edad, $localidad, $id);
        $stmt->execute();
        header("Location: ./usuarios.php");
    } else {
        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_all(MYSQLI_ASSOC);
        return $usuario;
    }
}

function crearUsuario() {
    if (isset($_GET["guardar"])) {
        $mysqli = getConnection();
        $login = $_GET["login"];
        $password = $_GET["password"];
        $rol = $_GET["rol"];
        $nombre = $_GET["nombre"];
        $apellidos = $_GET["apellidos"];
        $edad = $_GET["edad"];
        $localidad = $_GET["localidad"];
        $stmt = $mysqli->prepare("INSERT INTO usuarios (login, password, rol, nombre, apellidos, edad, localidad, online) VALUES (?,?,?,?,?,?,?, 0)");
        $stmt->bind_param('sssssis', $login, $password, $rol, $nombre, $apellidos, $edad, $localidad);
        $stmt->execute();
        header("Location: ./usuarios.php");
    }
}

function usuariosOnline() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT login FROM usuarios WHERE online = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $usuariosOnline = $result->fetch_all(MYSQLI_ASSOC);
    return $usuariosOnline;
}

function getFotos() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM imagenes");
    $stmt->execute();
    $result = $stmt->get_result();
    $fotos = $result->fetch_all(MYSQLI_ASSOC);
    return $fotos;
}

function borrarFoto() {
    $mysqli = getConnection();
    $id = $_GET["foto"];
    if (isset($_GET["borrar"])) {
        $stmt = $mysqli->prepare("DELETE FROM imagenes WHERE id = $id");
        $stmt->execute();
        header("Location: fotos.php");
    }
    $stmt = $mysqli->prepare("SELECT * FROM imagenes WHERE id = $id");
    $stmt->execute();
    $result = $stmt->get_result();
    $foto = $result->fetch_all(MYSQLI_ASSOC);
    return $foto;

}

function editarFoto() {
    $mysqli = getConnection();
    $id = $_GET["foto"];
    if (isset($_GET["guardar"])) {
        $titulo = $_GET["titulo"];
        $descripcion = $_GET["descripcion"];
        $stmt = $mysqli->prepare("UPDATE imagenes SET titulo = ?, descripcion = ? WHERE id = ?");
        $stmt->bind_param('ssi', $titulo, $descripcion, $id);
        $stmt->execute();
        header("Location: ./fotos.php");
    }
}

function borrarCategoria() {
    if (isset($_GET["borrar"])) {
        $mysqli = getConnection();
        if (isset($_GET["categoria"])) {
            $categoria = $_GET["categoria"];
            $stmt = $mysqli->prepare("DELETE FROM cat_subcat WHERE categoria = ?");
            $stmt->bind_param('s', $categoria);
            $stmt->execute();
        }
        if (isset($_GET["subcategoria"])) {
            $subcategoria = $_GET["subcategoria"];
            $stmt = $mysqli->prepare("DELETE FROM cat_subcat WHERE subcategoria = ?");
            $stmt->bind_param('s', $subcategoria);
            $stmt->execute();
        }
        header("Location: ./index.php");
    }
}