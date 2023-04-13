
<?php

class Viaje {

    private $nroViaje;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $arregloPasajeros = [];


    public function __construct($nroviaje, $destino, $cantidadMaximaPasajeros)
    {
        $this->nroviaje = $nroviaje;
        $this->destino = $destino;
        $this->cantidadMaximaPasajeros = $cantidadMaximaPasajeros;
    }


    //Funciones Getters
    public function getArregloPasajero($indice){
        if($indice < count($this->pasajeros)) 
        return $this->arregloPasajeros[$indice];
        else return [];
    }


    public function getNroViaje(){
        return $this->nroviaje;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getCantidadMaxima(){
        return $this->cantidadMaximaPasajeros;
    }


    //Funciones Setters
    public function setNroViaje($newViaje){
        $this->newViaje=$newViaje;
    }


    public function setDestino($newDestino){
        $this->destino=$newDestino;
    }

    public function setCapacidadMaxima($newCapacidadMaximja){
        $this->capacidadMaxima=$newCapacidadMaxima;
    }


    //Esta funcion agrega un pasajero al final del arreglo pasajeros
    public function agregarPasajero($pasajero){
        array_push($this->arregloPasajeros, $pasajero);
    }
    
    //Esta funcion busca un pasajero usando como clave el dni del pasajero y retorna el indice donde se encuentra dicho dni
    public function buscarPasajero($dni){
        $i = 0;
        $indice = -1;
        $control = true;
        while($i < count($this->arregloPasajeros) && $control){
            if($this->arregloPasajeros[$i]['dni'] == $dni){
                $indice = $i;
                $control = false;
            }
            $i++;
        }

        return $indice;
    }  


    /*Esta funcion modifica un pasajero*/
    public function modificarPasajero($indice, $nuevoNombre, $nuevoApellido){
        $this->arregloPasajeros[$indice]['nombre'] = $nuevoNombre;
        $this->arregloPasajeros[$indice]['apellido'] = $nuevoApellido;
    }


    /* */
    public function cantidadAsientosDisponibles(){
        return $this->cantidadMaximaPasajeros - count($this->pasajeros);
    }


}