// DATATABLE - GENERAL OPTIONS
$(document).ready( function () {
    $('.dataTable').DataTable({
        "ordering" : false,
        "language" : {
            "sProcessing"        : "Procesando...",
            "sLengthMenu"        : "Mostrar _MENU_ registros",
            "sZeroRecords"       : "No se encontraron resultados",
            "sEmptyTable"        : "Ningún dato disponible",
            "sInfo"              : "Registros del _START_ al _END_ (_TOTAL_ registros)",
            "sInfoEmpty"         : "0 Registros",
            "sInfoFiltered"      : "- (filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"       : "",
            "sSearch"            : '<span class="fa fa-search"></span>',
            "sSearchPlaceholder" : "Buscar",
            "sUrl"               : "",
            "sInfoThousands"     :  ",",
            "sLoadingRecords"    : "Cargando...",
            "oPaginate"          : {
                "sFirst"    : "Primero",
                "sLast"     : "Último",
                "sNext"     : "Siguiente",
                "sPrevious" : "Anterior"
            },
            "oAria"              : {
                "sSortAscending"  : ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
            }
        },
        "lengthMenu" : [[10,25,50,-1],["10","25","50","Todos"]],
        "fixedColumns": true
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    setDarkMode($('#status_dark_mode').val());
    if($('.over-auto-datatable'))
        $('.over-auto-datatable').parent().css({"overflow":'auto'});
} );

// GENERAL FUNCTION TO GET DATA
function getDataForm(form_id){
    let data = new FormData(form_id);
    try {
        for (const dato of data.entries()) {
            const element = dato[1]; //dato[1] => valor
            var campo     = document.getElementById(dato[0]); //dato[0] => Llave(name)
            if((element == 0 || typeof element == 'undefined' || element == null) && campo.getAttribute('data-required') == 'true')
            {
                showAlert('CUIDADO',`El campo ${campo.getAttribute('data-name')} está vacío, favor de llenarlo`,'yellow');
                $(`#${dato[0]}`).focus();
                return false;
            }
        }
        return data;
    } catch (error) {
        console.error('El ID y el NAME de los inputs debe ser igual, DATA-NAME se usa para detectar el nombre del input vacío');
        console.error('ERROR => ', error);
        return false;
    }
};

// RESET FORM
$('.resetForm').on('click',resetDataForm);
function resetDataForm(){
    $(this).parents('form').first().trigger('reset');
    $.each($('.message_repeat_password'),function(key,element){
        element.innerHTML = '';
    })
}

// CONEXION CONTROLLER
function conexionController(url,type,data = {}){
    return $.ajax({
        "url"         : url,
        "method"      : type,
        "type"        : type,
        "data"        : data,
        "dataType"    : 'json',
        "contentType" : false,
        "processData" : false,
        "cache"       : false,
        success       : function(response) {
            // response.addHeader("Access-Control-Allow-Methods", "GET, POST, PATCH, PUT, DELETE");
            // console.log("Response from the factory => ",response);               
        },
        error : function(error){
            console.log(error);
        }
    });
}

// EMAIL VALIDATION
function emailValidation(correo){
    let validation = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo.val())
    if(validation)
    {
        return true;
    }else{
        showAlert('CUIDADO','El correo que ingresó debe ser válido','yellow');
        correo.focus();
        return false;
    }
}

// SHOW ALERT NOTIFY
function showAlert(titulo,mensaje,color){
    iziToast.show({
        title    : titulo,
        message  : mensaje,
        color    : color,
        position : 'topRight',
        layout   : 2,
        balloon  : true
    });
}

// SHOW INPUT - PASSWORD
$('.show_password').click(showPassword);
function showPassword(){
    let input_password = $(this).parents().siblings('input.change_password'),
        icon           = $(this).find('.icon_show_password');

    switch (input_password.attr('type')) {
        case 'password':
                input_password.attr('type','text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            break;

        case 'text':
                input_password.attr('type','password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            break;

        default:
            showAlert('CUIDADO','No es posible cambiar este tipo de input','yellow');
    }
}

// REPEAT PASSWORD VALIDATION
$('.check_password').on('input', function(){
    //1.- Write this class on the inputs you want to check (.check_password)
    //2.- Write this classes on the inputs you want to check (.first_password && .second_password)
    let password   = $(this).parents('form').find('.first_password').first(),
        password_2 = $(this).parents('form').find('.second_password').first();

    if(password.val() == password_2.val())
        $(this).parents('form').find('.message_repeat_password').first().html('<span><i class="fas fa-check-circle"></i> Contraseñas correctas<span>').css({"color":"green"});
    else
        $(this).parents('form').find('.message_repeat_password').first().html('<span><i class="fas fa-times-circle"></i> Las contraseñas deben coincidir<span>').css({"color":'red'});
});

// ACTIVATE DATEPICKER
let fecha_actual = new Date();
$('.datepickerSingle').daterangepicker({ //single DatePicker
    "locale": {
        // format: 'DD/MM/YYYY hh:mm A'
        "format"     : 'YYYY/MM/DD',
        "daysOfWeek" : ["Lun","Mar","Mier","Jue","Vie","Sáb","Dom"],
        "monthNames" : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    },
    "autoUpdateInput"  : false, //disable default date
    "singleDatePicker" : true,
    "showDropdowns"    : true,
    "minDate"          : fecha_actual,
    "minYear"          : fecha_actual.getFullYear() - 1,
    "maxYear"          : fecha_actual.getFullYear() + 5,
    "opens"            : "left",
    "drops"            : "up"
});

$('.datepickerSingle').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY'));
});

// ACTIVATE SELECT2
$('.select2').select2({
    theme:'bootstrap4'
});
$('[data-mask]').inputmask()
// timePicker
$('.timepicker').datetimepicker({
    format: 'LT',
    sideBySide: true,
    icons: {
        up: "fas fa-arrow-up",
        down: "fas fa-arrow-down",
        next: 'fa fa-chevron-circle-right',
        previous: 'fa fa-chevron-circle-left'
    }
})
// Icon picker
$('.iconPicker').iconpicker({
    placement: 'right',
    templates: {
        search: '<input type="search" class="form-control iconpicker-search" placeholder="Buscar icono..." />'
    }
});
$('.iconpicker-popover').removeClass('fade');

// Dark Mode
$('#dark-mode').click(darkMode);
function setDarkMode(status) {
    if(status == 1){
        $('.change_dark').addClass('background-dark box-shadow-dark');
        $('.change-card').addClass('background-card');
        $('.change-table').addClass('table-dark');
        $('.change-modal-color').addClass('modal-dark');
    }
}
// Function to change darkMode
function darkMode(){
    let mode;
    $('#dark-mode').toggleClass('active',!$('#dark-mode').hasClass('active'));
    $('.change_dark').toggleClass('background-dark box-shadow-dark', !$('.change_dark').hasClass('background-dark') || !$('.change_dark').hasClass('box-shadow-dark'));
    $('.change-card').toggleClass('background-card',!$('.change-card').hasClass('background-card'));
    $('.change-table').toggleClass('table-dark',!$('.change-table').hasClass('table-dark'));
    $('.change-modal-color').toggleClass('modal-dark',!$('.change-modal-color').hasClass('modal-dark'));
    // toggleClass => Primero ejecuta addClass y si no cumple el segundo parametro ejecuta removeClass
    if($('#dark-mode').hasClass('active'))
        mode = 0;
    else
        mode = 1;
    let data = new FormData();
    data.append('mode',mode);
    data.append('id',$('#user_id').val());
    conexionController(window.location.origin + '/setDarkMode','POST',data).then(function(response){
        if(!response.error){
            showAlert('¡EXITO!',response.message,'green');
        }
    });
}

// General function submit form to create
function saveData(_this){ // "_this" must be equal to actual form where´s making the submit 
    let form       = _this.attr('id'),
        data       = getDataForm(_this[0]),
        url        = _this.attr('action');
    if(typeof data === 'object'){
        let typeMethod = data.get("_method") || _this.attr('method');
        return conexionController(url,typeMethod,data);
    }
}

// General function to open Modal
$(document).on('click','.openModal', openModal);
function openModal(modal = undefined){
    if(modal != undefined)
        $(`#${modal}`).modal('show');
    else
        $(`#${$(this).attr('data-modal')}`).modal('show');
}

//General function to open Modal and set values on form
$(document).on('click','.openModalAndGetValues', function(event){
    event.preventDefault();
    let _this = $(this);
    conexionController($(this).attr('data-route'),'GET').then(function(response){
        if(!response.error){
            let datosUsuario = response.data;
            for (const key in datosUsuario) {
                if (datosUsuario.hasOwnProperty(key)) {
                    // GENERAL DATA
                    if(datosUsuario[key] != null && key != 'profile_picture'){
                        if(typeof datosUsuario[key] == 'string'){
                            $(`#${_this.attr('data-modal')} form #${key}`).val(datosUsuario[key]);
                            if(key == 'start_date'){
                                let date = new Date(datosUsuario[key]);
                                let dateTimeFormat = new Intl.DateTimeFormat('en', { "year": 'numeric', "month": '2-digit', "day": '2-digit' }) 
                                let [{ value: month },,{ value: day },,{ value: year }]  = dateTimeFormat.formatToParts(date);
                                $(`#${_this.attr('data-modal')} form #${key}`).val(`${day}/${month}/${year}`);
                            }
                        } else {
                            $(`#${_this.attr('data-modal')} form #${key}`).val(datosUsuario[key]);
                        }
                        if(key == 'id')
                            $(`#${_this.attr('data-modal')} form #route`).val(`${$(location).attr('href')}/${datosUsuario[key]}`);
                    }
                    // PROFILE PICTURE
                    if(key == 'profile_picture') {
                        if(datosUsuario[key] != null){
                            $(`#${_this.attr('data-modal')} form img`).attr('src',`${window.location.origin}/storage/avatars/${datosUsuario[key]}`);
                        } else {
                            $(`#${_this.attr('data-modal')} form img`).attr('src',`${window.location.origin}/images/avatars/default-white.jpg`);
                        }
                    }
                    // EPIC ID
                    if(key == 'epic'){
                        if(datosUsuario[key] != null){
                            $(`#${_this.attr('data-modal')} form #epic_id`).val(datosUsuario[key].name);
                        }
                    }
                    // ROLE USER
                    if(key == 'roles'){
                        $(`#${_this.attr('data-modal')} form #role`).val(datosUsuario[key][0].name)
                        $(`#role`).trigger('change');
                    }
                    $(`#${key}`).trigger('change');
                }
            }
            openModal(_this.attr('data-modal'));
        } else {
            swal({
                title: "¡ERROR!",
                text: response.message,
                icon: "error",
            });
        }
    });
});

// Function to edit data
function editData(_this){
    let form       = _this.attr('id'),
        data       = getDataForm(_this[0]),
        url        = data.get("route");
    if(typeof data === 'object'){
        let typeMethod = data.get("_method") || _this.attr('method');
        return conexionController(url,typeMethod,data);
    }
}

// Function to open delete modal and set values
$(document).on('click','.deleteRegister', function(){
    $(`#${$(this).attr('data-modal')} #id_delete`).val($(this).attr('data-id'));
    $(`#${$(this).attr('data-modal')} #route_delete`).val($(this).attr('data-route'));
    $(`#${$(this).attr('data-modal')}`).modal('show');
});

// Function to delete register
function deleteRegister(_this){
    let form       = _this.attr('id'),
        data       = getDataForm(_this[0]),
        url        = data.get("route");
    if(typeof data === 'object'){
        let typeMethod = data.get("_method") || _this.attr('method');
        return conexionController(url,typeMethod);
    }
}

// Function to active load button
function loadButton() {
    if($('.spinEfect').hasClass('buttonDisabled')){
        $('.spinEfect').attr('disabled',false).removeClass('buttonDisabled');
        $('.spinEfect .spinner-border').addClass('d-none');
        $('.spinEfect #button-text').text('Agregar');
    } else {
        $('.spinEfect').attr('disabled',true).addClass('buttonDisabled');
        $('.spinEfect .spinner-border').removeClass('d-none');
        $('.spinEfect #button-text').text('Procesando');
    }
}