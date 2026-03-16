<?php
class Entrenadora{
    private $nombre;
    private $pokemons;

    public function __construct($nombre){
        $this->nombre = $nombre;
        $this->pokemons = [];
    }

    public function getPokemons() {
        return $this->pokemons;
        }

    public function CazarPokemon(Pokemon $pokemon) {
            // Verificamos si el equipo tiene espacio (máximo 6 como en los juegos)
            if (count($this->pokemons) < 6) {
                $suerte = rand(1, 100);

                if ($suerte > 30) { // 70% de probabilidad de éxito
                    $this->pokemons[] = $pokemon;
                    echo "<p>¡Hecho!" . $this->nombre . " ha capturado a " . $pokemon->getNombre() . "</p>";
                } else {
                    echo "<p>¡Oh no! El Pokémon <b>" . $pokemon->getNombre() . "</b> ha huído...</p>";
                }

            } else {
                echo "<p>¡El equipo está lleno! No puedes capturar más de 6 Pokémon.</p>";
            }
        }

    public function getNombre() { 
        return $this->nombre; 
    }

    public function MostrarEquipo(){
    if(empty($this->pokemons)){
        return "<p>" . $this->nombre . " no tiene pokemons en su equipo.</p>";
    }
    $lista ="<h3>Equipo de " . $this->nombre . ":</h3>";
    foreach($this->pokemons as $pokemon){
        $lista .= "<div>" . $pokemon->MostrarInfo() . "</div><hr>";
    }
    return $lista;
}

    public function MostrarInfo(){
        return "<p>Nombre: " . $this->nombre . "</p>" . "<p>Pokemons en el equipo: " . count($this->pokemons) . "</p>";
    }



}
