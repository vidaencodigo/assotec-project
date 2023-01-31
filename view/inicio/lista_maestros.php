<?php if (isset($maestros)) : ?>
    <?php if (($maestros)) : ?>
        <table class="table">
            <thead>
                <th>-</th>
                <th>Nombre Completo</th>
                <th>
                    Materias
                </th>
                <th>Acciones</th>
            </thead>
            <tbody>


                <?php
                // para listar las materias de maestros
                // se invoca el modelo

                $materias = new MaestroModel();
                foreach ($maestros as $maestro) : ?>
                    <tr>
                        <td>
                            <?php if ($maestro->profile_image) : ?>
                                <img src="data:image/png;base64,<?= base64_encode($maestro->profile_image) ?>" class="img-thumbnail" style="width:50px; height:50px;" alt="Imagen de perfil">
                            <?php else : ?>
                                <div style="display:flex; width:50px; height:50px; border-radius:50%; background-color:#737373; color:#fff;"></div>
                            <?php endif; ?>

                        </td>

                        <td>
                            <?= $maestro->name; ?> <?= $maestro->last_name; ?>
                        </td>
                        <td>
                            <?php
                            // por cada maestro al modelo se manda los datos de maestros

                            $materias->id_usuario = $maestro->id;
                            $materias->rol = "maestro";

                            foreach ($materias->get_all_subjects() as $materia) :
                            ?>
                                <span class="badge rounded-pill bg-purple ">
                                    <?= $materia->name; ?>
                                </span>
                            <?php endforeach; ?>
                        </td>
                        <td>
                        
                            <a href="index.php?controller=asesorias&action=get_all_asesorias_alumo&id_usuario=<?=$maestro->id?>" class="btn btn-link">Ver asesorias</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>