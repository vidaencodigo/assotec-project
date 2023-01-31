<?php if ($asesorias) : ?>
    <table class="table">
        <thead>
            <th>Mataria</th>
            <th>Tipo</th>
            <th>Salon</th>
            <th>Dia</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>-</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach ($asesorias as $asesoria) : ?>
                <tr>
                    <td><?= $asesoria->materia ?></td>

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
                    <td>

                        <a href="#" class="btn btn-outline-info">Ver detalles</a>


                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>