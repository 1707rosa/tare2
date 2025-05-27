<?php
include("libreria/main.php");

$obra= new Obra();

if(isset($_GET['codigo'])){
    $ruta = 'datos/' . $_GET['codigo'] . '.json';
    if(is_file(filename: $ruta)){
        $json = file_get_contents(filename: $ruta);
        $obra = json_decode(json: $json);
    } 
}

if($_POST){
    $obra->codigo = $_POST['codigo'];
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

     
    if(!is_dir(filename:'datos')){
        mkdir(directory:'datos');
    }

    if(!is_dir(filename:'datos')){
        echo "Error al crear el directorio, no se pudo guardar la obra.";
        echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a>";
        exit();
    }

    $ruta= 'datos/' .$obra->codigo. '.json';

    $json= json_encode(value: $obra);

    file_put_contents(filename: $ruta, data: $json);

    
    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra guardada correctamente.</div>";
    echo "<a href='index.php' class='btn btn-primary mb-4'>Volver al listado</a>";
    exit();



}

plantilla::aplicar();
?>
<div class="mx-auto px-3">
<form method="post" action="editar.php" >
<!--codigo de la obra-->
<div class="mb-3">
    <label for="codigo" class="form-label">Código</label>
    <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $obra->codigo ?>" required>
</div>

<!--foto de la obra-->
<div class="mb-3">
    <label for="foto_url" class="form-label">Foto</label>
    <input type="url" class="form-control" id="foto_url" name="foto_url" value="<?= $obra->foto_url ?>" required>
</div>

<!--Tipo de obra-->
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select class="form-select" id="tipo" name="tipo" required>
            <option value="" disabled selected>Seleccione un tipo</option>
            <?php
            $selected= $obra->tipo;
            foreach (Datos::Tipos_de_Obra() as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            ?>
        </select>
    </div>

<!--Nombre de la obra-->
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $obra->nombre ?>" required>
</div>

<!--Descripcion de la obra-->
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?= $obra->descripcion ?></textarea>
</div>

<!--Pais de la obra-->
<div class="mb-3">
    <label for="pais" class="form-label">País</label>
    <input type="text" class="form-control" id="pais" name="pais" value="<?= $obra->pais ?>" required>
</div>

<!--Autor de la obra-->
<div class="mb-3">
    <label for="autor" class="form-label">Autor</label>
    <input type="text" class="form-control" id="autor" name="autor" value="<?= $obra->autor ?>" required>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-primary btn-lg shadow mb-3">Guardar</button>
    <a href="index.php" class="btn btn-secondary btn-lg shadow mb-3">Cancelar</a>
</div>
</form>
</div>