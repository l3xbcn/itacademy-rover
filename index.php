<?php
namespace Resources;
include 'Resources/Rover.php';
include 'Resources/Field.php';
include 'Resources/Session.php';
include 'Resources/Error.php';
define('SECURE', true); // impide que se cargue el contenedor con el formuulario desde URL

session_start(); // inicializa o recupera la sesión

if (isset($_GET['restart'])) {
    unset($_SESSION['rover']);
}

if (isset($_POST['new']) || isset($_SESSION['rover'])) { // obtiene los datos del terreno y posición/orientación del Rover en caso de nuevo lanzamiento o los actuales de un lanzamiento anterior
    $session = new Session();
    $json_decode = json_decode($_SESSION['rover']);
    $field = new Field(intval($json_decode->width), intval($json_decode->height));
    if (!$field->check()) {
        // En caso de que los datos del terreno no sean correctos los borra y borra también los datos de sesión
        unset($field);
        unset($_SESSION['rover']);
        Error::fieldDataBad();
    } else {
        $rover = new Rover(intval($json_decode->coordinateX), intval($json_decode->coordinateY), $json_decode->orientation);
    }
}

if (isset($_POST['new']) && isset($field)) { // en caso de nuevo lanzamiento - sobre un terreno con tamaño correcto - se comprueba que no se haya perdido la cobertura del Rover
    if ($rover->check($field) == false) {
        Error::lost();
    }
}

if (isset($_SESSION['rover']) && isset($field)) { // en caso de orden al Rover se ejecuta y se compreba que no se haya perdido su cobertura.
    if (isset($_POST['order'])) {
        if ($rover->order(strtoupper($_POST['orders']), $field) == false) {
            Error::lost();
        }
    }
    $session->save($field->getWidth(), $field->getHeight(), $rover->getCoordinateX(), $rover->getCoordinateY(), $rover->getOrientation()); // Se guardan los datos actuales del Rover en la variable de sesión. También se guardan los datos del terreno aunque no cambien porque ambos se codifican en una variable de sesión en un JSON
    $field->draw($rover); // Se dibuja el terreno y se sitúa en él al Rover
}

?>
<?php include 'Resources/containers/Container.php'; ?> <!-- Formulario -->
