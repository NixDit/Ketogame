<div class="modal fade" id="editAdmin" tabindex="-1" role="dialog" aria-labelledby="editAdminLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content change-modal-color">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdminLabel">Editar administrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-register" method="POST" modal-id="editAdmin">
                <div class="modal-body">
                    @csrf
                    <div class="d-flex justify-content-center mb-4">
                        <img src="" class="img-circle elevation-2" style="width: 70px; height: 70px;" alt="User Image">
                    </div>
                    <!-- Nombre del administrador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" data-name="nombre(s)" placeholder="Nombre(s) del administrador" data-required="true">
                    </div>
                    <!-- Apellidos del administrador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                        </div>
                        <input type="text" class="form-control" id="lastname" name="lastname" data-name="apellido(s)" placeholder="Apellidos(s) del administrador" data-required="true">
                    </div>
                    <!-- Correo del administrador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" data-name="correo" placeholder="Correo del administrador" data-required="true">
                    </div>
                    <!-- Contraseña del administrador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" data-name="contraseña" placeholder="Contraseña del administrador">
                    </div>
                    <!-- EPIC ID -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="number" class="form-control" id="epic_id" name="epic_id" data-name="epic ID" placeholder="EPIC ID">
                    </div>
                    <!-- País del administrador -->
                    <div class="input-group mb-3" style="color: #495057;">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-globe"></i></span>
                        </div>
                        <select class="form-control select2" data-placeholder="País del administrador" name="country_id" id="country_id" data-name="país" data-required="true">
                            <option value=""></option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Teléfono del administrador -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="tel" class="form-control" id="mobile" name="mobile" data-name="teléfono" placeholder="Teléfono de contacto" data-required="true" data-inputmask="'mask': ['999-999-9999']" data-mask>
                    </div>
                    <!-- Cargo del administrador -->
                    <div class="input-group mb-3" style="color: #495057;">
                        <div class="input-group-prepend">
                            <span class="input-group-text adjusting-append-icons"><i class="fas fa-user-tie"></i></span>
                        </div>
                        <select class="form-control select2" data-placeholder="Cargo del administrador" name="role" id="role" data-name="role" data-required="true">
                            <option value=""></option>
                            <option value="superadmin">Superadmin</option>
                            <option value="moderator">Moderador</option>
                            <option value="guest">Jugador</option>
                        </select>
                    </div>
                    {{-- Imagen del administrador --}}
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