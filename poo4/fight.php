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
    <link rel="icon" type="image/x-icon" href="img/pokeball.png">
    <title>Fight Entrenadora</title>
</head>
<body class='fondo-cuarto'>
    <h1 class="tituloLucha">Batalla Pokémon</h1>

    <form method="POST" action="">
        <section>
            <h3>Selecciona a la primera Entrenadora</h3>
            <select name="entre1" class='select'>
               <?php
                foreach ($_SESSION["entrenadoras"] as $identrenadoras => $entrenadora) {
                    echo "<option value='$identrenadoras'>" . $entrenadora->MostrarInfo() . "</option>";
                }
                ?>
            </select>
        </section>

        <section>
            <h3>Selecciona a la segunda Entrenadora</h3>
            <select name="entre2" class='select'>
                <?php
                foreach ($_SESSION["entrenadoras"] as $identrenadoras => $entrenadora) {
                    echo "<option value='$identrenadoras'>" . $entrenadora->MostrarInfo() . "</option>";
                }
                ?>
            </select>
            <p>
        <button type="submit">Enviar</button>
        </p>
        </section>

    </form>

    <section>
    <?php
    if(isset($_POST['entre1'],$_POST['entre2'])){
        $n_entrenadora1=$_POST['entre1'];
        $n_entrenadora2=$_POST['entre2'];
        $entrenadora1=$_SESSION['entrenadoras'][$n_entrenadora1];
        $entrenadora2=$_SESSION['entrenadoras'][$n_entrenadora2];
        if($entrenadora1 != $entrenadora2){
            
            echo "<form method='POST' action=''>
            <section class='pokemon'>
            <h3>Selecciona el Pokémon de ".$entrenadora1->MostrarInfo()."</h3>
                <select name='pokemon1' class='select'>";

            foreach ($_SESSION["pokemons"] as $idpokemon => $pokemon) {
                    echo "<option value='$idpokemon'>" . $pokemon->getNombre() . "</option>";
                }

            echo"</select>
            </section>

            <section class='pokemon'>
            <h3>Selecciona el Pokémon de ".$entrenadora2->MostrarInfo()."</h3>
                <select name='pokemon2' class='select'>";

            foreach ($_SESSION["pokemons"] as $idpokemon => $pokemon) {
                    echo "<option value='$idpokemon'>" . $pokemon->getNombre() . "</option>";
                }

            echo "</select>
            <p>
                <button type='submit'>Enviar</button>
            </p>
            </section>
            </form>";
        }else{
            echo "<script>alert('No puedes elegir dos entrenadora mismo')</script>";
        }
    }

    if(isset($_POST['pokemon1'],$_POST['pokemon2'])){
        $n_pokemon1=$_POST['pokemon1'];
        $n_pokemon2=$_POST['pokemon2'];
        $pokemon1=$_SESSION['pokemons'][$n_pokemon1];
        $pokemon2=$_SESSION['pokemons'][$n_pokemon2];
        $ataque_vida1=$pokemon1->getDanio();
        $vida_pokemon1=$pokemon1->getVida();
        $ataque_vida2=$pokemon2->getDanio();
        $vida_pokemon2=$pokemon2->getVida();
        //start
        if($pokemon1 -> getVida() > 0 && $pokemon2 -> getVida() > 0){
        $pokemon1->restaVida($ataque_vida2);
        $pokemon2->restaVida($ataque_vida1);
        echo "<p>Pokemon 1 queda " . $pokemon1->getVida() . "</p>"; 
        echo "<p>Pokemon 2 queda " . $pokemon2->getVida() . "</p>";
        }else{
            if($pokemon1->getVida() > $pokemon2->getVida()){
                echo "pokemon1 ganado";
            }elseif($pokemon1->getVida()==$pokemon2->getVida()){
                echo "no hay pokemon gana, todos 0";
            }else{
                echo "pokemon2 ganado";
            }
        }
    }

    
    ?>

    <a class='button' href="index.php">Regresar a Gestión</a>
</section>
</body>
</html>