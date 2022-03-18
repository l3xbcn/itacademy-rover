<?php
namespace Resources;
use Resources\Session;
include 'Resources/Rover.php';
include 'Resources/Field.php';
include 'Resources/Session.php';
include 'Resources/Error.php';

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

if (isset($_POST['new']) && isset($field)) { // en caso de nuevo lanzamiento se compreba que no se haya perdido la cobertura del Rover
    $session = new Session();
    if ($rover->check($field) == false) {
        Error::lost();
    }
}

if (isset($_SESSION['rover'])  && isset($field)) { // en caso de orden al Rover se ejecuta y se compreba que no se haya perdido su cobertura.
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body, table {
            margin: 32px;
        }
        td,
        .rover {
            width: 32px;
            height: 32px;
        }
        .coordinate {
            background-color: black;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        .rover {
            background-color: aqua;
            color: blue;
            font-size: 24px;
            text-align: center;
        }
        h1 a {
            text-decoration: none;
            color:black;
            font-weight: bold;            
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h1><a href="/index.php">The Rover Project</a></h1>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#new" aria-expanded="false" aria-controls="new">
            Nuevo lanzamiento
        </button>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#post" aria-expanded="false" aria-controls="post">
            POST variables
        </button>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#session" aria-expanded="false" aria-controls="session">
            SESSION variables
        </button>
        <div class="collapse" id="post">
            <pre>POST JSON: <?= json_encode($_POST) ?></pre>
        </div>
        <div class="collapse" id="session">
            <pre>SESSION JSON: <?= $_SESSION['rover'] ?></pre>
        </div>
        <div class="collapse" id="new">
            <form novalidate action="index.php" method="post">
                <h2>Terreno</h2>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="width" id="width" aria-describedby="widthHelp" placeholder="Anchura del terreno" min=1>
                    <label for="exampleInputEmail1">Anchura del terreno</label>
                    <small id="widthHelp" class="form-text text-muted">Debe ser un número.</small>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="height" id="height" aria-describedby="heightHelp" placeholder="Altura del terreno" min=1>
                    <label for="exampleInputEmail1">Altura del terreno</label>
                    <small id="heightHelp" class="form-text text-muted">Debe ser un número.</small>
                </div>
                <h2>Rover</h2>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="coordinate-x" id="coordinate-x" aria-describedby="coordinate-xHelp" placeholder="Coordenada X del rover" min=0>
                    <label for="coordinate-x">Coordenada X del rover</label>
                    <small id="coordinate-xHelp" class="form-text text-muted">Debe ser un número.</small>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="coordinate-y" id="coordinate-y" id="coordinate-y" aria-describedby="coordinate-yHelp" placeholder="Coordenada Y del rover" min=0>
                    <label for="coordinate-y">Coordenada Y del rover</label>
                    <small id="coordinate-yHelp" class="form-text text-muted">Debe ser un número.</small>
                </div>
                <label class="form-check-label">
                    Orientación
                </label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientation" id="orientation-n" value="N" checked>
                    <label class="form-check-label" for="orientation-n">
                        N
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientation" id="orientation-s" value="S">
                    <label class="form-check-label" for="orientation-s">
                        S
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientation" id="orientation-e" value="E">
                    <label class="form-check-label" for="orientation-e">
                        E
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientation" id="orientation-w" value="W">
                    <label class="form-check-label" for="orientation-w">
                        W
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="new" value=1>Lanzar rover</button>
                </div>
            </form>
        </div>
        <?php if (isset($_SESSION['rover'])) { ?>
            <form novalidate action="index.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="orders" id="orders" aria-describedby="ordersHelp" placeholder="Órdenes">
                    <label for="orders">Órdenes</label>
                    <small id="ordersHelp" class="form-text text-muted">Debe ser una o más órdenes (caracteres L / R / A, el resto son ignorados)</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="order" value=1>Ordenar </button>
                </div>
            </form>
        <?php } ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </div>
</body>

</html>