 <?php if ($this->subject->get_all_active($usuario->id)) : ?>
     <table class="table">
         <thead>
             <th>Materia</th>
             <th>Acciones</th>
             <th>

             </th>
             <th>

             </th>
         </thead>
         <tbody>
             <?php foreach ($user_subject as $materia) : ?>
                 <tr>
                     <td>
                         <?= $materia->name; ?>
                     </td>
                     <td>

                         <a href="index.php?controller=schedule&action=get_form_schedule&subjectId=<?= $materia->id; ?>" class="btn btn-link"> Registrar o ver dias</a>
                     </td>
                     <td>

                         <a href="index.php?controller=subject&action=get_form_delete&subjectId=<?= $materia->id; ?>" class="btn btn-outline-danger"> Borrar materia</a>
                     </td>
                     <td>
                         <a href="index.php?controller=asesorias&action=get_new_form&subjectId=<?= $materia->id; ?>" class="btn btn-outline-primary"> Registrar nueva asesoria</a>
                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 <?php else : ?>
     <div class="card">
         <div class="card-header">
             <h4>

                 No tienes materias registradas
             </h4>
         </div>
         <div class="card-body">
             <h5 class="card-title">Da click para registrar nueva materia</h5>
             <div class="my-5 d-flex justify-content-center">

                 <a href="index.php?controller=subject&action=get_index" class="btn btn-primary">Registra</a>
             </div>
         </div>
     </div>

 <?php endif; ?>