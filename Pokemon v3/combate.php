<?php
require_once 'pokemon.php';
require_once 'entrenadora.php';
session_start();

// Datos de ejemplo para el catálogo y rivales
$enemigas = ["Team Rocket", "Líder Gym", "Rival Azul"];
$catalogo = [
    ["nombre" => "Pikachu", "nivel" => 35],
    ["nombre" => "Bulbasaur", "nivel" => 15],
    ["nombre" => "Charizard", "nivel" => 70]
];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos.css">
    <title>Combate Pokémon</title>
    <link rel="icon" type="image/x-icon" href="img/pokeball.png">
</head>
<body>
    <section>
        <h1>Zona de Combate</h1>

        <form method="POST" action="">
            <p>1. Elige tu Entrenadora:</p>
            <select name="id_entrenadora" class='select'>
                <option value="">-- Seleccionar --</option>
                <?php
                foreach ($_SESSION["entrenadoras"] as $indice => $ent) {
                    // Mantenemos la selección si ya se pulsó el botón
                    $selected = (isset($_POST['id_entrenadora']) && $_POST['id_entrenadora'] == $indice) ? "selected" : "";
                    echo "<option value='$indice' $selected>" . $ent->getNombre() . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="seleccionar_entrenadora" value="Ver Equipo">

            <hr>

            <?php 
            // PASO 2: Si se ha elegido entrenadora, mostramos sus Pokémon
            if (isset($_POST['id_entrenadora']) && $_POST['id_entrenadora'] !== ""): 
                $id_ent = $_POST['id_entrenadora'];
                $entrenadoraObj = $_SESSION["entrenadoras"][$id_ent];
                $susPokemons = $entrenadoraObj->getPokemons();
            ?>
                <p>2. Elige tu Pokémon para luchar:</p>
                <select name="id_pokemon" class='select'>
                    <?php
                    foreach ($susPokemons as $id_p => $p) {
                        echo "<option value='$id_p'>" . $p->getNombre() . "</option>";
                    }
                    ?>
                </select>
                <p><input type="submit" name="luchar" value="¡EMPEZAR COMBATE!"></p>
            <?php endif; ?>
        </form>
    </section>

    <section>
        <?php
        // PASO 3: Lógica del resultado del combate
        if (isset($_POST['luchar'])) {
            $miEnt = $_SESSION["entrenadoras"][$_POST['id_entrenadora']];
            $miPok = $miEnt->getPokemons()[$_POST['id_pokemon']];
            
            // Lógica simple para buscar nivel similar (suponiendo nivel 10 si es nuevo)
            $enemigoFinal = $catalogo[0]; 
            foreach ($catalogo as $posible) {
                // Buscamos uno que no supere mucha diferencia de nivel
                if (abs($posible['nivel'] - 10) < 25) { 
                    $enemigoFinal = $posible;
                }
            }

            $nombreRival = $enemigas[array_rand($enemigas)];

            echo "<h3>¡COMBATE!</h3>";
            echo "<p>Tu <b>" . $miPok->getNombre() . "</b> contra <b>" . $enemigoFinal['nombre'] . "</b> de " . $nombreRival . "</p>";
            echo "<p>" . $miPok->Atacar() . "</p>";
        }
        ?>
    </section>
    <section>
        <a class='button' href="index.php">Volver a gestión</a>
    </section>
</body>
</html>