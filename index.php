<?php
namespace Resources;
include 'Resources/Rover.php';
include 'Resources/Field.php';
include 'Resources/Session.php';
var_dump($POST);
if (isset($_POST['new'])) {
    new Session();
}
if (isset($_SESSION['rover'])) {
    $json_decode = json_decode($_SESSION['rover']);
    $field = new Field($json_decode->width, $json_decode->height);
    $rover = new Rover($json_decode->coordinateX, $json_decode->coordinateY, $json_decode->orientation);
}

?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h1>Rover Project</h1>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#post" aria-expanded="false" aria-controls="post">
            POST variables
        </button>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#session" aria-expanded="false" aria-controls="session">
            SESSION variables
        </button>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#new" aria-expanded="false" aria-controls="new">
            Nuevo lanzamiento
        </button>
        <div class="collapse" id="post">
            <pre>
                <?php var_dump($_POST) ?>
            </pre>
        </div>
        <div class="collapse" id="session">
            <pre>
                <?php var_dump($_SESSION['rover']) ?>
            </pre>
        </div>
        <div class="collapse" id="new">
            <form novalidate action="index.php" method="post">
                <h2>Terreno</h2>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="width" id="width" aria-describedby="widthHelp" placeholder="Anchura del terreno">
                    <label for="exampleInputEmail1">Anchura del terreno</label>
                    <small id="widthHelp" class="form-text text-muted">Debe ser un número.</small>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="height" id="height" aria-describedby="heightHelp" placeholder="Altura del terreno">
                    <label for="exampleInputEmail1">Altura del terreno</label>
                    <small id="heightHelp" class="form-text text-muted">Debe ser un número.</small>
                </div>
                <h2>Rover</h2>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="coordinate-x" id="coordinate-x" aria-describedby="coordinate-xHelp" placeholder="Coordenada X del rover">
                    <label for="coordinate-x">Coordenada X del rover</label>
                    <small id="coordinate-xHelp" class="form-text text-muted">Debe ser un número.</small>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="coordinate-y" id="coordinate-y" id="coordinate-y" aria-describedby="coordinate-yHelp" placeholder="Coordenada Y del rover">
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
                    <input class="form-check-input" type="radio" name="orientation" id="orientation-e" value="e">
                    <label class="form-check-label" for="orientation-e">
                        E
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientation" id="orientation-w" value="w">
                    <label class="form-check-label" for="orientation-w">
                        W
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="new" value="1">Lanzar rover</button>
                </div>
            </form>
        </div>
        <?php if (isset($_SESSION['rover'])) { ?>
        <form novalidate action="index.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="order" id="order" aria-describedby="orderHelp" placeholder="Órdenes">
                <label for="coordinate-x">Órdenes</label>
                <small id="coordinate-xHelp" class="form-text text-muted">Debe ser una o más órdenes L / R / A.</small>
            </div>
        </form>
        <?php } ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </div>
</body>

</html>