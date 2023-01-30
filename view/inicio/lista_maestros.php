<?php if (isset($maestros)) : ?>
    <?php if (($maestros)) : ?>
        <table class="table">
            <thead>
                <th>-</th>
                <th>Nombre Completo</th>
                <th>Acciones</th>
            </thead>
            <tbody>


                <?php foreach ($maestros as $maestro) : ?>
                    <tr>
                        <td>
                            <?php if ($maestro->profile_image) : ?>
                                <img src="data:image/png;base64,<?= base64_encode($maestro->profile_image) ?>" class="img-thumbnail" style="width:50px; height:50px;" alt="Imagen de perfil">
                            <?php else : ?>
                                <div style="display:flex; width:50px; height:50px; border-radius:50%; background-color:#737373; color:#fff;"></div>
                            <?php endif; ?>

                        </td>
                        <td>
                            <?=$maestro->name; ?> <?=$maestro->last_name; ?>
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>