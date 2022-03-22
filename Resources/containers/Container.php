<?php !defined('SECURE') and exit; ?>
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
                <small id="widthHelp" class="form-text text-muted">Debe ser un número mayor que 0.</small>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="height" id="height" aria-describedby="heightHelp" placeholder="Altura del terreno" min=1>
                <label for="exampleInputEmail1">Altura del terreno</label>
                <small id="heightHelp" class="form-text text-muted">Debe ser un número mayor que 0.</small>
            </div>
            <h2>Rover</h2>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="coordinate-x" id="coordinate-x" aria-describedby="coordinate-xHelp" placeholder="Coordenada X del rover" min=0>
                <label for="coordinate-x">Coordenada X del rover</label>
                <small id="coordinate-xHelp" class="form-text text-muted">Debe ser un número (entre 0 y anchura del terreno-1, por defecto 0).</small>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="coordinate-y" id="coordinate-y" id="coordinate-y" aria-describedby="coordinate-yHelp" placeholder="Coordenada Y del rover" min=0>
                <label for="coordinate-y">Coordenada Y del rover</label>
                <small id="coordinate-yHelp" class="form-text text-muted">Debe ser un número (entre 0 y altura del terreno-1, por defecto 0).</small>
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
</div>