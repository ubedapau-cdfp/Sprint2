<?php
require_once 'Pokemon.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pokemon</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <section>
        <h1>Crear Pokemon</h1>
        <form method="POST" action="detalle.php" enctype="multipart/form-data">
            <label for="nombre"><p>Nombre</p></label>
            <input type="text" name="nombre" id="nombre">

            <!-- DESPLEGABLE ELEMENTO (tipo primario) -->
            <label for="elemento"><p>Elemento</p></label>
            <select name="elemento" id="elemento">
                <option value="">-- Selecciona un elemento --</option>
                <option value="Fuego"> Fuego</option>
                <option value="Agua"> Agua</option>
                <option value="Planta"> Planta</option>
                <option value="Eléctrico"> Eléctrico</option>
                <option value="Hielo"> Hielo</option>
                <option value="Lucha"> Lucha</option>
                <option value="Veneno"> Veneno</option>
                <option value="Tierra"> Tierra</option>
                <option value="Volador"> Volador</option>
                <option value="Psíquico"> Psíquico</option>
                <option value="Bicho"> Bicho</option>
                <option value="Roca"> Roca</option>
                <option value="Fantasma"> Fantasma</option>
                <option value="Dragón"> Dragón</option>
                <option value="Siniestro"> Siniestro</option>
                <option value="Acero"> Acero</option>
                <option value="Hada"> Hada</option>
                <option value="Normal"> Normal</option>
            </select>

            <!-- DESPLEGABLE TIPO (categoría del Pokémon) -->
            <label for="tipo"><p>Tipo</p></label>
            <select name="tipo" id="tipo">
                <option value="">-- Selecciona un tipo --</option>
                <optgroup label="Por origen">
                    <option value="Inicial">Inicial</option>
                    <option value="Legendario">Legendario</option>
                    <option value="Mítico">Mítico</option>
                    <option value="Ultraente">Ultraente</option>
                    <option value="Paradoja">Paradoja</option>
                </optgroup>
                <optgroup label="Por forma">
                    <option value="Mega Evolución">Mega Evolución</option>
                    <option value="Forma Gigamax">Forma Gigamax</option>
                    <option value="Forma Alola">Forma Alola</option>
                    <option value="Forma Galar">Forma Galar</option>
                    <option value="Forma Hisui">Forma Hisui</option>
                    <option value="Forma Paldea">Forma Paldea</option>
                </optgroup>
                <optgroup label="Por rareza">
                    <option value="Común">Común</option>
                    <option value="Poco común">Poco común</option>
                    <option value="Raro">Raro</option>
                    <option value="Fósil">Fósil</option>
                    <option value="Bebé">Bebé</option>
                    <option value="Pseudo-legendario">Pseudo-legendario</option>
                </optgroup>
            </select>

            <label for="ataque"><p>Ataque</p></label>
            <input type="text" name="ataque" id="ataque"><p></p>

            <label for="descripcion"><p>Descripción</p></label>
            <input type="text" name="descripcion" id="descripcion" placeholder="Descripción del Pokémon"><p></p>

            <label for="imagen"><p>Imagen del Pokémon</p></label>
            <input type="file" name="imagen" id="imagen" accept="image/*"><p></p>

            <input type="submit" value="Crear">
        </form>
    </section>

    <section>
    <?php
    if (!isset($_SESSION["pokemons"])) {
        $_SESSION["pokemons"] = [];
    }

    if (isset($_POST["nombre"], $_POST["elemento"], $_POST["tipo"], $_POST["ataque"])) {
        $nombre      = $_POST["nombre"];
        $elemento    = $_POST["elemento"];
        $tipo        = $_POST["tipo"];
        $ataque      = $_POST["ataque"];
        $descripcion = $_POST["descripcion"] ?? "";
        $rutaImagen  = "";

        // Validar que se hayan seleccionado elemento y tipo
        if (empty($elemento) || empty($tipo)) {
            $mensaje = "Error: debes seleccionar un elemento y un tipo.";
        } else {
            // --- Procesamiento de la imagen ---
            if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {

                $carpetaDestino = "imagenes/";

                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0755, true);
                }

                $tipoMime = mime_content_type($_FILES["imagen"]["tmp_name"]);
                $tiposPermitidos = ["image/jpeg", "image/png", "image/gif", "image/webp"];

                if (in_array($tipoMime, $tiposPermitidos)) {
                    $extension     = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
                    $nombreArchivo = strtolower($nombre) . "_" . uniqid() . "." . $extension;
                    $rutaFinal     = $carpetaDestino . $nombreArchivo;

                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaFinal)) {
                        $rutaImagen = $rutaFinal;
                        $mensaje = "Pokémon creado con éxito.";
                    } else {
                        $mensaje = "Error: no se pudo guardar la imagen.";
                    }
                } else {
                    $mensaje = "Error: el archivo no es una imagen válida.";
                }

            } else {
                $mensaje = "Pokémon creado sin imagen.";
            }

            if (!str_starts_with($mensaje, "Error")) {
                $pokemon = new Pokemon($nombre, $elemento, $tipo, $ataque, $descripcion, $rutaImagen);
                $_SESSION["pokemons"][] = $pokemon;
            }
        }
    }

    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
    }
    ?>
    </section>

    <section>
        <h2>Pokémon creados</h2>
        <?php
        if (count($_SESSION["pokemons"]) > 0) {
            foreach ($_SESSION["pokemons"] as $pokemon) {
                echo $pokemon->mostrarInfo();
                if (method_exists($pokemon, 'getImagen') && $pokemon->getImagen()) {
                    echo '<img src="' . htmlspecialchars($pokemon->getImagen()) . '" 
                               alt="' . htmlspecialchars($pokemon->getNombre()) . '" 
                               style="width:150px; height:auto;">';
                }
            }
        } else {
            echo "<p>No hay Pokémon creados todavía</p>";
        }
        ?>
    </section>

    <a href="gestion.php">Ir a gestión</a>
    <a href="crearentrenadora.php">Ir a creación de entrenadoras</a>
</body>
</html>
