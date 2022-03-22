<?php
namespace Resources;

class Error {
    /**
     * Escribe en pantalla que el Rover ha perdido la comunicación
     * 
     * @return void
     */
    static function lost() {
        echo '<div class="alert alert-danger" role="alert">Se ha perdido la comunicación con el Rover!</div>';
    }

    /**
     * Escribe en pantalla que los datos del terreno no son correctos
     * 
     * @return void
     */
    static function fieldDataBad() {
        echo '<div class="alert alert-danger" role="alert">Los datos del terreno no son correctos. La cuadrícula debe medir como mínimo 1x1</div>';
    }    

}
