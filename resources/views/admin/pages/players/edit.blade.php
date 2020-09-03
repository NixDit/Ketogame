<div class="modal fade" id="editPlayer" tabindex="-1" role="dialog" aria-labelledby="editPlayerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content change-modal-color">
            <div class="modal-header">
                <h5 class="modal-title" id="editPlayerLabel">Editar jugador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-register" method="POST" modal-id="editPlayer">
                <div class="modal-body">
                    @csrf
                    <div class="d-flex justify-content-center mb-4">
                        <img src="" class="img-circle elevation-2" style="width: 70px; height: 70px;" alt="User Image">
                    </div>
                    <!-- Nombre del jugador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" data-name="nombre(s)" placeholder="Nombre(s) del jugador" data-required="true">
                    </div>
                    <!-- Apellidos del jugador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                        </div>
                        <input type="text" class="form-control" id="lastname" name="lastname" data-name="apellido(s)" placeholder="Apellidos(s) del jugador" data-required="true">
                    </div>
                    <!-- Correo del jugador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" data-name="correo" placeholder="Correo del jugador" data-required="true">
                    </div>
                    <!-- Contraseña del jugador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" data-name="contraseña" placeholder="Nueva contraseña del jugador">
                    </div>
                    <!-- EPIC ID -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="number" class="form-control" id="epic_id" name="epic_id" data-name="epic ID" placeholder="EPIC ID">
                    </div>
                    <!-- País del jugador -->
                    <div class="input-group mb-3" style="color: #495057;">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-globe"></i></span>
                        </div>
                        <select class="form-control select2" data-placeholder="País del jugador" name="country_id" id="country_id" data-name="país" data-required="true">
                            <option value=""></option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Teléfono del jugador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="tel" class="form-control" id="mobile" name="mobile" data-name="teléfono" placeholder="Teléfono de contacto" data-required="true" data-inputmask="'mask': ['999-999-9999']" data-mask>
                    </div>
                    {{-- Imagen del jugador --}}
                    <div class="form-group">
                        <label for="profile_picture">Nueva imagen</label>
                        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
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