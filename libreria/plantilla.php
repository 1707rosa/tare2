<?php


class plantilla{
    public static $instancia = null;

    public static function aplicar(): plantilla {
        if (self::$instancia === null) {
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }




public function __construct(){
    ?>
  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lo que he visto</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
</head>
<body>
    <div class="container py-5">
        <header class="text-center mb-5">
           
            <h1 class="display-4 fw-bold"><a href="index.php" style="text-decoration: none; ">Series y Películas ✅</a></h1>
            <p class="fs-5 text-muted">Listado de películas y series que he visto 🎬🍿</p>
        </header>

<div class="table-responsive shadow rounded">
    <?php
}

public function __destruct(){
    ?>
     </div>
    </div>

    <footer class="text-center mt-6">
        Derechos reservados &copy; <?= date('Y') ?> - Rosa Sanchez
    </footer>


</body>
</html>
    <?php
}   
}