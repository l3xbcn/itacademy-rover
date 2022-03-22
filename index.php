<?php
namespace Resources;
include 'Resources/Rover.php';
include 'Resources/Field.php';
include 'Resources/Session.php';
include 'Resources/Error.php';
define('SECURE', true); // impide que se cargue el contenedor con el formuulario desde URL

session_start(); // inicializa o recupera la sesión

if (isset($_POST['new']) || isset($_SESSION['rover'])) { // obtiene los datos del terreno y posición/orientación del Rover en caso de nuevo lanzamiento o los actuales de un lanzamiento anterior
    $session = new Session();
    $json_decode = json_decode($_SESSION['rover']);
    if ($json_decode->width < 1 || $json_decode->height < 1) {
        Error::fieldDataBad();
    } else {
        $field = new Field(intval($json_decode->width), intval($json_decode->height));
        $rover = new Rover(intval($json_decode->coordinateX), intval($json_decode->coordinateY), $json_decode->orientation);
    }
}

if (isset($_POST['new']) && isset($field)) { // en caso de nuevo lanzamiento - correcto - se compreba que no se haya perdido la cobertura del Rover
    $session = new Session();
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
<html>

<head>
    <link href="/Resources/styles/roverproject.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'Resources/containers/Container.php'; ?>
</body>

</html>