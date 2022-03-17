<?php
namespace Resources;

class Session {
    /**
     * Inicializa el objeto de sesión donde se guardan los datos del terreno y los de posición/orientación del Rover
     * Si se pasó por POST un nuevo lanzamiento guarda los datos del terreno y los de posición/orientación del Rover
     * Se guardan en formato JSON en una variable de sesión
     * 
     * @return void
     */
    function __construct() {
        if (isset($_POST['new'])) {
            $width        = $_POST['width'];
            $height       = $_POST['height'];
            $coordinateX  = $_POST['coordinate-x'];
            $coordinateY  = $_POST['coordinate-y'];
            $orientation  = $_POST['orientation'];
            $this->save($width, $height, $coordinateX, $coordinateY, $orientation);
        }
    }

    /**
     * Guarda los datos del terreno y los de posición/orientación del Rover
     * Se guardan en formato JSON en una variable de sesión
     */
    function save($width, $height, $coordinateX, $coordinateY, $orientation) {
        $_SESSION['rover'] = "{\"width\": $width, \"height\": $height, \"coordinateX\": $coordinateX, \"coordinateY\": $coordinateY, \"orientation\": \"$orientation\"}";
    }


}