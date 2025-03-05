<?php
function cabecerahtml() { ?>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="cs" />
    <meta name="robots" content="all,follow" />

    <meta name="author" content="All: ... [Nazev webu - www.url.cz]; e-mail: info@url.cz" />
    <meta name="copyright" content="Design/Code: Vit Dlouhy [Nuvio - www.nuvio.cz]; e-mail: vit.dlouhy@nuvio.cz" />
    
    <title>CrystalX</title>
    <meta name="description" content="..." />
    <meta name="keywords" content="..." />
    
    <link rel="index" href="./" title="Home" />
    <link rel="stylesheet" media="screen,projection" type="text/css" href="./css/main.css" />
    <link rel="stylesheet" media="print" type="text/css" href="./css/print.css" />
    <link rel="stylesheet" media="aural" type="text/css" href="./css/aural.css" />
</head>
<body>
<?php } ?>
<?php function navbar() { ?>
<!-- Main -->
<div id="main" class="box">

    <!-- Header -->
    <div id="header">

        <!-- Logotyp -->
        <h1 id="logo"><a href="./" title="CrystalX [Go to homepage]">Crystal<strong>X</strong><span></span></a></h1>
        <hr class="noscreen" />          

        <!-- Quick links -->
        <div class="noscreen noprint">
            <p><em>Quick links: <a href="#content">content</a>, <a href="#tabs">navigation</a>, <a href="#search">search</a>.</em></p>
            <hr />
        </div>

        <!-- Search -->
        <div id="search" class="noprint">
            <form action="" method="get">
                <fieldset><legend>Search</legend>
                    <label><span class="noscreen">Find:</span>
                    <span id="search-input-out"><input type="text" name="" id="search-input" size="30" /></span></label>
                    <input type="image" src="design/search_submit.gif" id="search-submit" value="OK" />
                </fieldset>
            </form>
        </div> <!-- /search -->

    </div> <!-- /header -->

     <!-- Main menu (tabs) -->
     <div id="tabs" class="noprint">
            <h3 class="noscreen">Navigation</h3>
            <ul class="box">
                <li id="active"><a href="index.php">Home<span class="tab-l"></span><span class="tab-r"></span></a></li>
                <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") { ?>
                    <li><a href="usuarios.php">Usuarios<span class="tab-l"></span><span class="tab-r"></span></a></li>
                <?php } ?>
                <li><a href="#">Weblog<span class="tab-l"></span><span class="tab-r"></span></a></li> <!-- Active -->                
                <li><a href="fotos.php">Photos<span class="tab-l"></span><span class="tab-r"></span></a></li>
                <li><a href="#">Portfolio<span class="tab-l"></span><span class="tab-r"></span></a></li>
                <li><a href="#">Contact<span class="tab-l"></span><span class="tab-r"></span></a></li>
                <li><a href="salir.php">Salir<span class="tab-l"></span><span class="tab-r"></span></a></li>
            </ul>

        <hr class="noscreen" />
     </div> <!-- /tabs -->
<?php } ?>
<?php function contenido() { ?>
    <!-- Page (2 columns) -->
    <div id="page" class="box">
    <div id="page-in" class="box">

        <!-- Content -->
        <div id="content">
        <?php $artigos = getArticulos(); ?>
            <!-- Article -->

                <?php 
                for ($x = 0; $x < count($artigos); $x++) {
                    echo '<div class="article">';
                    echo "<h2><span><a href='#'>" . $artigos[$x]['titulo'] . "</a></span></h2>";
                    echo "<p class='info noprint'>
                    <span class='date'>" . $artigos[$x]['data'] . "</span><span class='noscreen'>,</span>
                    <span class='cat'><a href='#'>" . $_GET["categoria"] . "</a></span><span class='noscreen'>,</span>
                    <span class='user'><a href='#'>" .$artigos[$x]['autor'] ."</a></span><span class='noscreen'>,</span>
                    <span class='comments'><a href='#'>Comments</a></span>
                    </p>";
                    echo "<p>" . $artigos[$x]['contido'] . "</p>";
                    echo "<div style='display: flex; justify-content: flex-start; gap: 100px; margin-left: 5.5rem;'>";
                    echo "<p class='btn-more box'><strong><a href='editarPost.php?artigo=" . $artigos[$x]["id"] . "'>Editar</a></strong></p>";
                    echo "<p class='btn-more box'><strong><a href='borrarPost.php?artigo=" . $artigos[$x]["id"] . "'>Borrar</a></strong></p>";
                    echo "</div>";                    
                    echo '</div> <!-- /article -->';
                    echo '<hr class="noscreen" />';
                }
                
                ?>
        </div> <!-- /content -->

        <!-- Right column -->
        <div id="col" class="noprint">
            <div id="col-in">

                <!-- About Me -->
                <h3><span><a href="#">Perfil</a></span></h3>

                <div id="about-me">
                    <p><img src="design/tmp_photo.gif" id="me" alt="Yeah, it´s me!" />
                    <strong><?php echo $_SESSION["nombre"] ?></strong><br />
                    Edad: <?php echo $_SESSION["edad"] ?><br />
                    <?php echo $_SESSION["localidad"] ?><br />
                    Rol: <?php echo $_SESSION["rol"] ?><br />
                </div> <!-- /about-me -->
            <?php if ($_SESSION["rol"] == "admin") { ?>
                <hr class="noscreen" />
                <h3 ><span>Menu Administrador</span></h3>
                <ul id='category'>
                    <li><a href='crearPost.php'>Crear post</a></li>
                    <li><a href='crearCategoria.php'>Crear categoria</a></li>
                    <li><a href='borrarCategoria.php'>Borrar categoria</a></li>
                </ul>
            <?php } ?>
                <hr class="noscreen" />

                <h3 ><span>Usuarios Online</span></h3>
                <ul id='category'>
                    <?php 
                        $usuariosOnline = usuariosOnline();
                        for ($x = 0; $x < count($usuariosOnline); $x++) {
                            echo "<li><a>" . $usuariosOnline[$x]['login'] . "</a></li>";
                        }
                    ?>
                </ul>

                <hr class="noscreen" />
                <?php $categorias = getCategorias(); ?>
                <?php 
                //Listaje de categorías y subcategorías.
                    for ($x = 0; $x < count($categorias); $x++) {
                        if ($x == 0 || $categorias[$x]["categoria"] != $categorias[$x - 1]["categoria"]) {
                        echo "</ul>";
                        echo "<h3 ><span>". $categorias[$x]["categoria"] ."</span></h3>";
                        }
                    echo "<ul id='category'>
                        <li ";
                        //COMPROBAR QUE ES LA CATEGORÍA SELECCIONADA
                        //PARA AÑADIRLE EL ESTILO DESEADO
                        if ($_GET["categoria"] == $categorias[$x]["subcategoria"]) {
                            echo 'id="category-active"';
                        }
                        echo "><a href='index.php?categoria=". $categorias[$x]["subcategoria"] ."'>". $categorias[$x]["subcategoria"] ."</a></li>";
                    }
                    echo "</ul>";
                ?>
                

                <hr class="noscreen" />
            
            </div> <!-- /col-in -->
        </div> <!-- /col -->

    </div> <!-- /page-in -->
    </div> <!-- /page -->
<?php } ?>
<?php function footer() { ?>

    <!-- Footer -->
    <?php if(isset($_SESSION["usuario"])) { ?>
    <div id="footer">
        <div id="top" class="noprint"><p><span class="noscreen">Back on top</span> <a href="#header" title="Back on top ^">^<span></span></a></p></div>
        <hr class="noscreen" />
        
        <p id="createdby">created by <a href="http://www.nuvio.cz">Nuvio | Webdesign</a> <!-- DON´T REMOVE, PLEASE! --></p>

        <p id="copyright">Número de visitas: <?php echo $_COOKIE["contador"]; ?></p>

    </div> <!-- /footer -->
    <?php } ?>
</div> <!-- /main -->
</body>
</html>
<?php } ?> 
