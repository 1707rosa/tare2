<?php
include("libreria/main.php");
plantilla::aplicar();
?>
   

    <div class="d-flex justify-content-center mb-4 mt-4">
            <a href="editar.php" class="btn btn-primary btn-lg shadow">Añadir</a>
        </div>
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col" class="text-center">Tipo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Personajes</th>
                        <th scope="col" class="text-center">País</th>
                        <th scope="col">Autor</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                 
                      <?php

                    if(is_dir(filename:'datos')){

                        $archivos= scandir(directory:'datos');

                        foreach($archivos as $archivo){
                               $ruta = 'datos/' . $archivo;
                            if(is_file(filename: $ruta)) {
                             
                                $json = file_get_contents(filename: $ruta);
                                $obra = json_decode(json: $json);

                               
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                        </td>
                                        <td class="text-center"><?= $obra->tipo ?></td>
                                        <td><?= $obra->nombre ?></td>
                                        <td>
                                            <?= count($obra->personajes) ?>
                                        </td>
                                        <td class="text-center"><?= $obra->pais ?></td>
                                        <td><?= $obra->autor ?></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="editar.php?codigo=<?= $obra->codigo ?>" class="btn btn-outline-warning btn-sm me-2 shadow">Editar</a>
                                                <a href="personajes.php?codigo=<?= $obra->codigo ?>" class="btn btn-outline-info  btn-sm me-2 shadows">Personajes</a>
                                                <a href="detalle.php?codigo=<?= $obra->codigo ?>" class="btn btn-outline-danger btn-sm shadow">Detalles</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                
                            }
                        }
                    }
                    ?>
                    </tbody>
            </table>