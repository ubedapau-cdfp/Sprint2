<?php
class Pokemon {
    private $nombre;
    private $elemento;
    private $tipo;
    private $ataque;
    private $nivel;
    private $vida;

    public function __construct($nombre, $elemento, $tipo, $ataque){
        $this->nombre = $nombre;
        $this->elemento = $elemento;
        $this->tipo = $tipo;
        $this->ataque = $ataque;
        $this->nivel = 1;
        $this->vida = 100;
    }

    public function getNombre() {
    return $this->nombre;
}

    public function Atacar(){
        return $this->nombre . " ataca con " . $this->ataque . " y causa daño.";
    }
    

    public function Evolucionar(){
        $this->nivel++;
        $this->vida += 10;

        if ($this->nivel > 100){ 
            $this->nivel = 100; 
        }

        if ($this->vida > 340){ 
            $this->vida = 340;
        }

        if ($this->nivel>1&&$this->nivel<100){
            $message="<p>".$this->nombre . " ha evolucionado al nivel " . $this->nivel . " y ahora tiene " . $this->vida . " puntos de vida.</p>";
        }
        elseif ($this->nivel==100){
            $message="<p>".$this->nombre." no se puede evolucionar más. Nivel máximo.</p>";
        }
        return $message;
    }

    public function MostrarInfo(){
    return 
        "<p>Nombre: " . $this->nombre . "</p>" .
        "<p>Elemento: " . $this->elemento . "</p>" .
        "<p>Tipo: " . $this->tipo . "</p>" .
        "<p>Ataque: " . $this->ataque . "</p>" .
        "<p>Nivel: " . $this->nivel . "</p>" .
        "<p>Vida: " . $this->vida . "</p>";
    }

}
?>