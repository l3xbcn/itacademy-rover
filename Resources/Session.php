<?php
namespace Resources;

class Session {
    function __construct() {
        $width        = $_POST['width'];
        $height       = $_POST['height'];
        $coordinateX  = $_POST['coordinate-x'];
        $coordinateY  = $_POST['coordinate-y'];
        $orientation  = $_POST['orientation'];
        $this->save($width, $height, $coordinateX, $coordinateY, $orientation);
    }

    static function save($width, $height, $coordinateX, $coordinateY, $orientation) {
        $_SESSION['rover'] = "{\"width\": $width, \"height\": $height, \"coordinateX\": $coordinateX, \"coordinateY\": $coordinateY, \"orientation\": \"$orientation\"}";
    }


}