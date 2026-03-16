<?php
require_once 'pokemon.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pokemon</title>
    <link rel="icon" type="image/x-icon" href="img/pokeball.png">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <section>
        <h1>Crear Pokemon</h1>
        <form method="POST" action="">
        <input type="radio" id="deldata" name="opcion1" value="deldata">
        <label for="deldata">Borrar datos</label>
        <p></p>
        <label for="nombre"><p>Nombre</p></label>
        <input type="text" name="nombre">
        <label for="elemento"><p>Elemento</p></label>
        <input type="text" name="elemento">
        <label for="tipo"><p>Tipo</p></label>
        <input type="text" name="tipo">
        <label for="ataque"><p>Ataque</p></label>
        <input type="text" name="ataque"><p></p>
        <input type="submit" value="Crear Pokémon">
        </form>

    </section>

    <section>
    <?php
    if(!isset($_SESSION["pokemons"])){
        $_SESSION["pokemons"]=[];
    }

    if(isset($_POST["nombre"], ($_POST["elemento"]),($_POST["tipo"]),($_POST["ataque"]))){
        if (isset($_POST['opcion1'])&&$_POST['opcion1']==='deldata'){ 
        destruirDatos(); 
        $_SESSION['pokemons']=[];
        $mensaje="Datos borrados.";
        } else {
        $nombre = $_POST["nombre"];
        $elemento = $_POST["elemento"];
        $tipo = $_POST["tipo"];
        $ataque = $_POST["ataque"];

        $pokemon = new Pokemon($nombre, $elemento, $tipo, $ataque);
        $_SESSION["pokemons"][]=$pokemon;

        $mensaje= "Pokemon creado con éxito.";
        }
    }

    if (isset($mensaje)){
        echo "<p>$mensaje</p>";
    }  

    ?>
    </section>

    <section>
        <h2>Pokémon creados</h2>
        <?php
        if (count($_SESSION["pokemons"]) > 0) {
            foreach ($_SESSION["pokemons"] as $pokemon) {
                echo "<p>" . $pokemon->mostrarInfo() . "</p>";
                echo "<p> ----------------------- </p>";
            }
        } else {
            echo "<p>No hay Pokémon creados todavía</p>";
        }


        function destruirDatos(){ 
            $_SESSION['entrenadoras']=[];  
        }
        ?>
    </section>
    <section>
    <a class="button" href="index.php">Ir a gestión</a>
    <a class="button" href="crearentrenadora.php">Ir a creación de entrenadoras</a>
    </section>
</body>
</html>