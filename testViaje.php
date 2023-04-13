<?php
include_once 'Viajes.php';
$viaje;

/*MENU DE OPCIONES*/
do {
    echo "Ingrese una de las siguientes opciones:";
    menu();
    $opcion = intval(trim(fgets(STDIN)));
    switch ($opcion) {
        case 1:
            $viaje = opcion1();
            break;
        case 2:
            if(existeViaje($viaje)) $viaje = opcion2($viaje);
            break;
        case 3: 
            if(existeViaje($viaje))$viaje = opcion3($viaje);
            break;
        case 4: 
            if(existeViaje($viaje)) $viaje = opcion4($viaje);
            break;
        case 5:
            $opcion = -1;
            break;
    }
} while ($opcion != -1);

/**/
function menu(){
    echo '
    1. Crear un vuelo.
    2. Cargar un pasajero.
    3. Modificar un pasajero.
    4. Mostrar viaje.
    5. Salir.
    ';
}

/*Esta funcion agrega un nuevo vuelo*/ 
function opcion1(){
    echo "--------------------------\n";

    echo "Ingrese el nro de vuelo:\n";
    $nroVuelo = trim(fgets(STDIN));
    echo "Ingrese el destino\n";
    $destino = trim(fgets(STDIN));

    do {
        echo "Ingrese el maximo de pasajeros\n";
        $cantidadMaximaPasajeros = intval(trim(fgets(STDIN)));
        if($cantidadMaximaPasajeros == 0)
        echo "Ingrese un numero mayor a cero de pasajeros.\n";
    } while ($cantidadMaximaPasajeros == 0);
    return new Viaje($nrovuelo, $destino, $cantidadMaximaPasajeros);
}

/*Esta funcion agrega un nuevo pasajero al arreglo arregloPasajeros*/ 
function opcion2($viaje){
    echo "--------------------------\n";

    if($viaje->cantidadAsientosDisponibles() > 0){
        do {
            echo "Ingrese el dni del pasajero\n";
            $dni = intval(trim(fgets(STDIN)));
            $indice = $viaje->buscarPasajero($dni);
            if($indice != -1){
                echo "El pasajero ya esta registrado con el dni: \n".$dni; //Esto quiere decir que el dni que cargo mel pasajero ya existe

            }
        } while ($indice != -1);

        echo "Ingrese el nombre del pasajero\n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido del pasajero\n";
        $apellido = trim(fgets(STDIN));
        $viaje->agregarPasajero(['dni'=>$dni, 'nombre'=>$nombre, 'apellido'=>$apellido]);
    }else{
        echo "No quedan asientos disponibles\n";
    }
    return $viaje;
}

/*Esta funcion  modifica un pasajero*/
function opcion3($viaje){
    echo "--------------------------";
    do{
        echo "Ingrese el dni del pasajero:\n";
        $dni = intval(trim(fgets(STDIN)));
        $indice = $viaje->buscarPasajero($dni);
        if($indice == -1) echo "El pasajero con el dni: ".$dni." no esta registrado\n"; 
    }while($indice == -1);
    $pasajero = $viaje->getPasajero($indice); //Agrego un nuevo pasajero al arregloPasajero
    echo "Pasajero:"; 
    echo "Nombre: ".$pasajero['nombre']." ; Apellido: ".$pasajero['apellido']."\n";
    echo "Ingrese el nuevo nombre: \n";
    $nuevoNombre = trim(fgets(STDIN));
    echo "Ingrese el nuevo apellido:\n";
    $nuevoApellido = trim(fgets(STDIN));

    $viaje->modificarPasajero($indice, $nuevoNombre, $nuevoApellido);
    return $viaje;
}

/*Muestra un viaje*/ 
function opcion4($viaje){
    echo "--------------------------\n";
    echo "NroViaje:".$viaje->getNroViaje()."\n";
    echo 'Destino: '.$viaje->getDestino()."\n";
    echo 'Cantidad Maxima Pasajeros: '.$viaje->getCapacidadMaxima()."\n";
}

/* Verifica que haya un viaje creado */
function existeViaje($viaje){
    if(!isset($viaje)){
        echo "Tiene que crear el viaje primero.\n";
        return false;
    }
    return true;
}
/*COMENTARIO DE PRUEBA*/
?>