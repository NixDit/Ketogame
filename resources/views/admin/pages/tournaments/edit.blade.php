<div class="modal fade" id="editTournament" tabindex="-1" role="dialog" aria-labelledby="editTournamentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content change-modal-color">
            <div class="modal-header">
                <h5 class="modal-title" id="editTournamentLabel">Editar torneo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-register" method="POST" modal-id="editTournament">
                <div class="modal-body">
                    @csrf
                    <!-- Nombre del torneo -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" data-name="nombre" placeholder="Nombre del torneo" data-required="true">
                    </div>
                    {{-- Descripción del torneo --}}
                    <div class="form-group">
                        <label for="description">Descripción del torneo</label>
                        <textarea class="form-control" id="description" name="description" data-name="descripción" data-required="true" rows="3"></textarea>
                    </div>
                    {{-- Cantidad del premio --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-dollar-sign"></i></span>
                        </div>
                        <input type="number" class="form-control" id="prize_pool" name="prize_pool" data-name="premio" placeholder="Cantidad del premio" data-required="true">
                    </div>
                    {{-- Máximo de participantes --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-users"></i></span>
                        </div>
                        <input type="number" class="form-control" id="max_participants" name="max_participants" data-name="premio" placeholder="Máximo de jugadores" data-required="true">
                    </div>
                    <!-- Fecha del torneo -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" autocomplete="off" class="form-control datepickerSingle" id="start_date" name="start_date" data-name="fecha" placeholder="Fecha del torneo" data-required="true">
                    </div>
                    {{-- ID --}}
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="route" name="route">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary spinEfect d-flex align-items-center">
                        <span class="spinner-border spinner-border-sm mr-1 d-none" role="status" aria-hidden="true"></span>
                        <span id="button-text">Editar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>