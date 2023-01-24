<!-- Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModal">Dar de baja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?controller=users&action=set_user_innactive" method="post"> 
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">

                <div class="modal-body">
                    <h3>
                        Esta seguro de dar de baja el perfil?
                    </h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Si</button>
                </div>
            </form>
        </div>
    </div>
</div>