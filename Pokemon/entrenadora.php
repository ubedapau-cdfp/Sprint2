<?php
class Entrenadora{
    private $nombre;
    private $pokemons;

    public function __construct($nombre){
        $this->nombre = $nombre;
        $this->pokemons = [];
    }

    public function CazarPokemon($pokemon){
        $this->pokemons[] = $pokemon;
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