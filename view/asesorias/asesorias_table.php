<?php if ($asesorias) : ?>
    <table class="table">
        <thead>
            <th></th>
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
                        <a href="#" style="color:blueviolet;" onclick="loadData(
                            materia='<?= $asesoria->materia ?>',
                            tipo='<?= $asesoria->tipo ?>',
                            salon='<?= $asesoria->salon ?>',
                            fecha='<?= $asesoria->dia ?>',
                            inicio='<?= $asesoria->inicio ?>',
                            fin='<?= $asesoria->fin ?>',
                            url='<?= $asesoria->url_sesion ?>',
                            descripcion='<?= $asesoria->descripcion ?>')" 
                            data-bs-toggle="modal" 
                            data-bs-target="#dataAsesoria">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
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
                                <a href="index.php?controller=inscribe&action=get_alumnos&id_asesoria=<?= $asesoria->id; ?>&materia=<?= $asesoria->materia_id ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<h5>Mostrar alumnos</h5>">

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
                            <a href="index.php?controller=asesorias&action=get_asesoria_details&id_asesoria=<?= $asesoria->id ?>" class="btn btn-outline-info">Editar</a>
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


<!-- Modal -->
<div class="modal fade" id="dataAsesoria" tabindex="-1" aria-labelledby="dataAsesoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataAsesoriaLabel">Detalles de asesoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6><span id="title_asesoria">Title</span></h6>
                <p>
                    <strong>Tipo de asesoria:</strong> <span id="tipo_asesoria"></span>
                </p>
                <p>
                    <strong>Descripción de asesoria:</strong> <span id="descripcion_asesoria"></span>
                </p>
                <p>
                    <strong>Salón:</strong> <span id="salon_asesoria"></span>
                </p>
                <p>
                    <strong>Fecha:</strong> <span id="fecha_asesoria"></span>
                </p>
                <p>
                    <strong>Hora inicio:</strong> <span id="inicio_asesoria"></span>
                    <strong>Hora fin:</strong> <span id="fin_asesoria"></span>
                </p>

                <p>
                    <strong>Link asesoria virtual:</strong>
                    <a href="#" id="url_asesoria">
                        <i class="fa-solid fa-link"></i>
                        Ir
                    </a>

                    </span>

                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function loadData(materia, tipo, salon, fecha, inicio, fin, url, descripcion) {
        let titulo = document.querySelector("#title_asesoria");
        let tipo_a = document.querySelector("#tipo_asesoria");
        let salon_a = document.querySelector("#salon_asesoria");
        let fecha_a = document.querySelector("#fecha_asesoria");
        let inicio_a = document.querySelector("#inicio_asesoria");
        let fin_a = document.querySelector("#fin_asesoria");
        let link = document.querySelector("#url_asesoria");
        let descripcion_a = document.querySelector("#descripcion_asesoria");

        titulo.innerHTML = materia;
        tipo_a.innerHTML = tipo;
        salon_a.innerHTML=salon;
        fecha_a.innerHTML=fecha;
        inicio_a.innerHTML=inicio;
        fin_a.innerHTML=fin;
        descripcion_a.innerHTML=descripcion;
        link.setAttribute('href', url);
        link.setAttribute('target', "_blank");
    }
</script>