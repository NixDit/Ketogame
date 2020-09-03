<div class="modal fade" id="deleteRegister" tabindex="-1" role="dialog" aria-labelledby="deleteRegisterLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content change-modal-color">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRegisterLabel">ELIMINAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete-register" modal-id="deleteRegister">
                <div class="modal-body">
                    @csrf
                    @method('delete')
                    <p>¿Está seguro que desea continuar con la eliminación?</p>
                    {{-- ID --}}
                    <input type="hidden" id="id_delete" name="id">
                    <input type="hidden" id="route_delete" name="route">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary spinEfect d-flex align-items-center">
                        <span class="spinner-border spinner-border-sm mr-1 d-none" role="status" aria-hidden="true"></span>
                        <span id="button-text">Eliminar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>