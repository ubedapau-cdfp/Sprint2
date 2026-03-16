<?php
require_once "pokemon.php";
require_once "entrenadora.php";
session_start();

if (!isset($_SESSION["pokemons"])) {
    $_SESSION["pokemons"] = [];
}

if (!isset($_SESSION["entrenadoras"])) {
    $_SESSION["entrenadoras"] = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Gestión Pokémon</title>
</head>
<body>
    <h1>Gestión de Pokemons y Entrenadoras</h1>

    <form method="POST" action="">
        <section>
            <h3>Selecciona un Pokemon</h3>
            <select name="pokemon" class='select'>
               <?php
                foreach ($_SESSION["pokemons"] as $idPokemon => $pokemon) {
                    echo "<option value='$idPokemon'>" . $pokemon->getNombre() . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="atacar">Atacar</button>
            <button type="submit" name="evolucionar">Evolucionar</button>
            <button type="submit" name="mostrarPokemon">Info Pokémon</button>
        </section>

        <section>
            <h3>Selecciona una Entrenadora</h3>
            <select name="entrenadora" class='select'>
                <?php
                foreach ($_SESSION["entrenadoras"] as $idEntrenadora => $entrenadora) {
                    echo "<option value='$idEntrenadora'>" . $entrenadora->getNombre() . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="mostrarEntrenadora">Mostrar Info Entrenadora</button>
            <button type="submit" name="cazar">Cazar Pokémon</button>
        </section>

    </form>

    <section>
    <?php
    if (isset($_POST["atacar"], $_POST["pokemon"])) {
    $idPokemon = $_POST["pokemon"];

    if (isset($_SESSION["pokemons"][$idPokemon])) {
        $mensaje = $_SESSION["pokemons"][$idPokemon]->atacar();
    }
}

if (isset($_POST["evolucionar"], $_POST["pokemon"])) {
    $idPokemon = $_POST["pokemon"];

    if (isset($_SESSION["pokemons"][$idPokemon])) {
        $mensaje = $_SESSION["pokemons"][$idPokemon]->evolucionar();
    }
}

if (isset($_POST["mostrarPokemon"], $_POST["pokemon"])) {
    $idPokemon = $_POST["pokemon"];

    if (isset($_SESSION["pokemons"][$idPokemon])) {
        $mensaje = $_SESSION["pokemons"][$idPokemon]->mostrarInfo();
    }
}

if (isset($_POST["mostrarEntrenadora"], $_POST["entrenadora"])) {
    $idEntrenadora = $_POST["entrenadora"];

    if (isset($_SESSION["entrenadoras"][$idEntrenadora])) {
        $mensaje = $_SESSION["entrenadoras"][$idEntrenadora]->mostrarInfo();
    }
}

if (isset($_POST["cazar"], $_POST["entrenadora"], $_POST["pokemon"])) {
    $idEntrenadora = $_POST["entrenadora"];
    $idPokemon = $_POST["pokemon"];

    if (
        isset($_SESSION["entrenadoras"][$idEntrenadora]) &&
        isset($_SESSION["pokemons"][$idPokemon])
    ) {
        $mensaje = $_SESSION["entrenadoras"][$idEntrenadora]
            ->capturarPokemon($_SESSION["pokemons"][$idPokemon]);
    }
}
    
    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
    }   
    ?>

    <a class="button" href="crearpokemon.php">Crear Pokemon</a>
    <a class="button" href="crearentrenadora.php">Crear Entrenadora</a>
</section>
</body>
</html>