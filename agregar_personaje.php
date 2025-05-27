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

if($_POST){
    $personaje->cedula = $_POST['cedula'];
    $personaje->foto_url = $_POST['foto_url'];
    $personaje->nombre = $_POST['nombre'];
    $personaje->apellido = $_POST['apellido'];
    $personaje->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $personaje->sexo = $_POST['sexo'];
    $personaje->habilidades = $_POST['habilidades'];
    $personaje->comida_favorita = $_POST['comida_favorita'];
    

       if(!isset($obra->personajes)){
        $obra->personajes= [];
    }
    
    $obra->personajes[]= $personaje;

    if(!is_dir(filename:'datos')){
        echo "<div class='alert alert-danger'>Error al crear el directorio, no se pudo guardar el personaje.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a>";
        exit();
    }


    $ruta= 'datos/' .$obra->codigo. '.json';

   file_put_contents(filename: $ruta, data: json_encode(value: $obra));
        
 
    echo "<div class='alert alert-success'>Personaje guardado correctamente.</div>";
    echo "<a href='index.php' class='btn btn-primary mb-4'>Volver al listado</a>";
    exit();
}

?>


<!--Resumen de la obra-->

<div class= 'row'>
    <div class="col-mb-4">
        <h2>Nombre: <?= $obra->nombre ?></h2>
        <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" class="img-fluid" style="max-width: 200px; max-height: 200px;">
        <p><strong>Tipo:</strong> <?= $obra->tipo ?></p>
        <p><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
        <p><strong>País:</strong> <?= $obra->pais ?></p>
        <p><strong>Autor:</strong> <?= $obra->autor ?></p>
    </div>
 <div class="col-md-8">
        <h2> Datos del personaje</h2>
   <form method="post" action="agregar_personaje.php?codigo=<?= $obra->codigo ?>" enctype="multipart/form-data">
        <!--Cedula del personaje-->
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="<?= $personaje->cedula ?>" required>
        </div>

        <!--Foto del personaje-->
        <div class="mb-3">
            <label for="foto_url" class="form-label">Foto</label>
            <input type="url" class="form-control" id="foto_url" name="foto_url" value="<?= $personaje->foto_url ?>" required>
        </div>


        <!--Nombre del personaje-->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $personaje->nombre ?>" required>
        </div>

        <!--Apellido del personaje-->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $personaje->apellido ?>" required>
        </div>

        <!--Fecha de nacimiento del personaje-->
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $personaje->fecha_nacimiento ?>" required>
        </div>
        <!--Sexo del personaje-->   
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-select" id="sexo" name="sexo" required>
                <option value="" disabled selected>Seleccione un sexo</option>
                <option value="Masculino" <?= $personaje->sexo == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                <option value="Femenino" <?= $personaje->sexo == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                <option value="Otro" <?= $personaje->sexo == 'Otro' ? 'selected' : '' ?>>Otro</option>
            </select>
        </div>
        <!--Habilidades del personaje-->
        <div class="mb-3">
            <label for="habilidades" class="form-label">Habilidades</label>
            <textarea class="form-control" id="habilidades" name="habilidades" rows="3" required><?= $personaje->habilidades ?></textarea>
        </div>
        <!--Comida favorita del personaje-->
        <div class="mb-3">
            <label for="comida_favorita" class="form-label">Comida Favorita</label>
            <input type="text" class="form-control" id="comida_favorita" name="comida_favorita" value="<?= $personaje->comida_favorita ?>" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg shadow">Guardar Personaje</button>
            <a href="personajes.php?codigo=<?= $obra->codigo ?>" class="btn btn-secondary btn-lg shadow">Cancelar</a>
        </div>
    </form>
    </div>
</div>
 