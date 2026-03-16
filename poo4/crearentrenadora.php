<?php
require_once 'entrenadora.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Entrenadora</title>
    <link rel="icon" type="image/x-icon" href="img/pokeball.png">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class='fondo-tercero'>
    <section>
        <h1>Crear Entrenadora</h1>
        <form method="POST" action="">
        <input type="radio" id="deldata" name="opcion1" value="deldata">
        <label for="deldata">Borrar datos</label>
        <p></p>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre"><p></p>

        <input type="submit" value="Crear Entrenadora">
        </form>
    </section>

       <section>
    <?php
   if(!isset($_SESSION["entrenadoras"])){
        $_SESSION["entrenadoras"]=[];
    }
    
    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];

        if (isset($_POST['opcion1'])&&$_POST['opcion1']==='deldata'){ 
        destruirDatos(); 
        $_SESSION['entrenadoras']=[];
        $mensaje="Datos borrados.";
        } else {
        $entrenadora = new Entrenadora($nombre);
        $_SESSION["entrenadoras"][]=$entrenadora;

        $mensaje="Entrenadora creada con éxito.";
    }
    }

    if (isset($mensaje)){
        echo "<p>$mensaje</p>";
    }
    
    ?>
    </section>
    
     <section>
        <h2>Entrenadoras creadas</h2>
        <?php
        if (count($_SESSION["entrenadoras"]) > 0) {
            foreach ($_SESSION["entrenadoras"] as $entrenadora) {
                echo "<p>" . $entrenadora->mostrarInfo() . "</p>";
                echo "<p> ----------------------- </p>";
            }
        } else {
            echo "<p>No hay entrenadoras creadas todavía</p>";
        }


        function destruirDatos(){ 
            $_SESSION['entrenadoras']=[];  
        }
        ?>
    </section>
    <section>
        <a class="button" href="crearpokemon.php">Crear Pokemon</a>
        <a class="button" href="index.php">Ir a gestion</a>
    </section>
</body>
</html>