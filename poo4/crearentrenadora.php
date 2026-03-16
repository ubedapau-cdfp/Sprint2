<?php
require_once 'Entrenadora.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Entrenadora</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <section>
        <h1>Crear Entrenadora</h1>
        <form method="POST" action="">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre"><p></p>

        <input type="submit" value="crear">
        </form>
    </section>

       <section>
    <?php
   if(!isset($_SESSION["entrenadoras"])){
        $_SESSION["entrenadoras"]=[];
    }
    
    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];

        $entrenadora = new Entrenadora($nombre);
        $_SESSION["entrenadoras"][]=$entrenadora;

        $mensaje= "Entrenadora creada con éxito.";
    }

    if (isset($mensaje)){
        echo "<p>$mensaje</p>";
    }
    
    ?>
    </section>
    
     <section>
        <h2>Entrenadoras creadas</h2>
        <?php
if(!empty($_POST['nombre'])){
        if (count($_SESSION["entrenadoras"]) > 0 ) {
            foreach ($_SESSION["entrenadoras"] as $entrenadora) {
                echo "<p>" . $entrenadora->mostrarInfo() . "</p>";
            }
        } else {
            echo "<p>No hay entrenadoras creadas todavía</p>";
        }
        }
        ?>
    </section>
    <section>
        <a href="crearpokemon.php">Crear Pokemon</a>
        <a href="gestion.php">Ir a gestion</a>
    </section>
</body>
</html>
