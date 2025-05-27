<?php
include("libreria/main.php");

$obra= new Obra();

if(isset($_GET['codigo'])){
    $ruta = 'datos/' . $_GET['codigo'] . '.json';
    if(is_file(filename: $ruta)){
        $json = file_get_contents(filename: $ruta);
        $obra = json_decode(json: $json);
    }
    else{
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>No se ha especificado un código de obra.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a></div>";
    exit();
    }
        
}else{
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>No se ha especificado un código de obra.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a></div>";
    exit();
}

plantilla::aplicar();

?>
<!--detalle de la obra-->
<div class="row">
<div class="col-mb-4">
    <h2>Nombre: <?= $obra->nombre ?></h2>
    <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" class="img-fluid" style="max-width: 200px; max-height: 200px;">
    <p><strong>Tipo:</strong> <?= $obra->tipo ?></p>
    <p><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
    <p><strong>País:</strong> <?= $obra->pais ?></p>
    <p><strong>Autor:</strong> <?= $obra->autor ?></p>
</div>

<div class="col-md-8">
        <h2> Personajes de la obra</h2>
    <div class="text-end mb-3">
        <a href="agregar_personaje.php?codigo=<?= $obra->codigo ?>" class="btn btn-primary shadow">Añadir Personaje</a>
    </div>
    <div class="text-end mb-3">
    <a href='index.php' class='btn btn-primary'>Volver al listado</a>
    </div>

    <table class="table table-bordered table-hover align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col" class="text-center">Fecha de Nacimiento</th>
    
            </tr>
        </thead>
        <tbody>
           <?php
           foreach($obra->personajes as $personaje){
                echo "
            <tr>
            <td>
                <img src='{$personaje->foto_url}' alt='{$personaje->nombre} {$personaje->apellido}' class='img-fluid'>
            </td>
                <td>{$personaje->nombre}</td>
                <td>{$personaje->apellido}</td>
                <td class='text-center'>{$personaje->fecha_nacimiento}</td>
            </tr>
            ";
              }
            ?>

        </tbody>
</table>
</div>


</div>