<?php if ($asesorias) : ?>
    <table class="table">
        <thead>
            <th>Mataria</th>
            <th>Tipo</th>
            <th>Salon</th>
            <th>Dia</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <?php if ($_SESSION['rol'] == 'maestro') : ?>
                <th>
                    Inscritos
                </th>
            <?php endif; ?>

            <th>-</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach ($asesorias as $asesoria) : ?>
                <tr>
                    <td>
                        <?= $asesoria->materia ?>
                        
                    </td>

                    <td><?= $asesoria->tipo ?></td>
                    <td><?= $asesoria->salon ?></td>
                    <td>
                        <?php
                        echo  date('l', strtotime($asesoria->dia));
                        ?>
                        <br>
                        <?= $asesoria->dia ?>
                    </td>
                    <td><?= $asesoria->inicio ?></td>
                    <td><?= $asesoria->fin ?></td>
                    <?php if ($_SESSION['rol'] == 'maestro') : ?>
                        <td>
                            <h3>
                                <a href="index.php?controller=inscribe&action=get_alumnos&id_asesoria=<?=$asesoria->id;?>&materia=<?= $asesoria->materia_id ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<h5>Mostrar alumnos</h5>">

                                    <span class="badge bg-primary">
                                        <?php $asesoriaAlumno = new AsesoriaAlumnoModel;
                                        echo ($asesoriaAlumno->get_total($asesoria->id)->Total);
                                        ?>
                                    </span>
                                </a>
                            </h3>
                        </td>
                    <?php endif; ?>
                    <td>
                        <?php if ($_SESSION['rol'] == 'maestro') : ?>
                            <a href="index.php?controller=asesorias&action=get_asesoria_details&id_asesoria=<?= $asesoria->id ?>" class="btn btn-outline-info">Ver detalles</a>
                        <?php endif; ?>
                        <?php if ($_SESSION['rol'] == 'alumno') : ?>
                            <a href="index.php?controller=asesorias&action=get_asesoria_ins&id_asesoria=<?= $asesoria->id ?>" class="btn btn-outline-info">Inscribir</a>
                        <?php endif; ?>



                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>