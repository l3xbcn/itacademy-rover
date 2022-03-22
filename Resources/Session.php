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
            $width        = intval($_POST['width']);
            $height       = intval($_POST['height']);
            $coordinateX  = intval($_POST['coordinate-x']);
            $coordinateY  = intval($_POST['coordinate-y']);
            $orientation  = preg_match('/[' . Rover::$orientations . ']/',$_POST['orientation']) ? $_POST['orientation'] : 'N';
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