<?php
include("libreria/main.php");
plantilla::aplicar();

$obra= new Obra();

$personaje= new Personaje();

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

<div class="text-end">
    <button onclick="window.print()" class="btn btn-secondary mb-3">Imprimir</button>
</div>

<!--mostrar detalle de la obra y sus personajes-->

<div class="row">
    <div class="col-md-12">
        <h2>Nombre: <?= $obra->nombre ?></h2>
        <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" class="img-fluid" style="max-width: 200px; max-height: 200px;">
        <p><strong>Tipo:</strong> <?= $obra->tipo ?></p>
        <p><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
        <p><strong>País:</strong> <?= $obra->pais ?></p>
        <p><strong>Autor:</strong> <?= $obra->autor ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <h2>Personajes de la obra</h2>
        
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" >Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de Nacimiento</th>
                </tr>
            </thead>
            <tbody>
             <?php
                    foreach($obra->personajes as $personaje){
                        echo "<tr>";
                        echo "<td><img src='{$personaje->foto_url}' alt='{$personaje->nombre}' class='img-fluid'</td>";
                        echo "<td>{$personaje->nombre}</td>";
                        echo "<td>{$personaje->apellido}</td>";
                        echo "<td>{$personaje->fecha_nacimiento}</td>";
                        echo "</tr>";
                    }
               
                ?>
            </tbody>
        </table>
    </div>
</div>


    