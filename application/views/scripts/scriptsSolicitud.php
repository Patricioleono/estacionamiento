<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.5.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/popper.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.dataTables.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/dataTables.bootstrap5.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/sweetalert2.all.min.js"); ?>"></script>

<script> 
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<script>
$(document).ready(function(){
    setInterval(function(){
        $.ajax({
            url: '<?=base_url()?>index.php/solicitud/refreshA',
            method: 'post',
            data: {
            },
            dataType: 'json'
        }).done(function(result) 
        {
            auto = <?php echo $parametrosA ?>;
                
            document.getElementById("recargarAuto").innerHTML = auto - result;  
        })
        
    },5000);

    setInterval(function(){
        $.ajax({
            url: '<?=base_url()?>index.php/solicitud/refreshM',
            method: 'post',
            data: {
            },
            dataType: 'json'
        }).done(function(result) 
        {
            moto = <?php echo $parametrosM ?>;
                
            document.getElementById("recargarMoto").innerHTML = moto - result;   
        })
        
    },5000);

    setInterval(function(){
        $.ajax({
            url: '<?=base_url()?>index.php/solicitud/refreshB',
            method: 'post',
            data: {
            },
            dataType: 'json'
        }).done(function(result) 
        {
            bici = <?php echo $parametrosB ?>;
                
            document.getElementById("recargarBici").innerHTML = bici - result;   
        })
        
    },5000);
})
</script>

<script>
$("body").delegate( "[name=btnradioSu]", "change", function() { 
    var SiSu        = document.getElementById('SiSu').checked;
    var NoSu        = document.getElementById('NoSu').checked;

    if(SiSu){
        $("#ObservacionAutoSu").hide(" #ObservacionAutoSu");
    }else if(NoSu){
        $("#ObservacionAutoSu").show(" #ObservacionAutoSu");
    }
});
$("body").delegate( "[name=btnradio]", "change", function() { 
    var Si        = document.getElementById('Si').checked;
    var No        = document.getElementById('No').checked;

    if(Si){
        $("#ObservacionAuto").hide(" #ObservacionAuto");
    }else if(No){
        $("#ObservacionAuto").show(" #ObservacionAuto");
    }
});
$("body").delegate( "[name=btnradioVeh]", "change", function() { 
    var SiVeh        = document.getElementById('SiVeh').checked;
    var NoVeh        = document.getElementById('NoVeh').checked;

    if(SiVeh){
        $("#ObservacionAutoVeh").hide(" #ObservacionAutoVeh");
    }else if(NoVeh){
        $("#ObservacionAutoVeh").show(" #ObservacionAutoVeh");
    }
});
$(document).ready(function() {
    $('#añadirSolicitudX').click(function(){    

        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var hour = ("0" + now.getHours()).slice(-2);
        var minute = ("0" + now.getMinutes()).slice(-2);
        var second = ("0" + now.getSeconds()).slice(-2);

        var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
        $("#fecha").val(today);

        var semana = [];
        $('input[name="diasSemana"]:checked').each(function(){
            var dia= {};
            dia.codigo = $(this).val();
            semana.push(dia);
        });

        let autos = [];
        document.querySelectorAll('#miTabla2> tbody tr').forEach(function(e){
            let fila = {
                marca  : e.querySelector('.marca').innerText,
                modelo : e.querySelector('.modelo').innerText,
                patente : e.querySelector('.patente').innerText,
                propietario : e.querySelector('.propietario').innerText,
                observacion : e.querySelector('.observacion').innerText
                };
            autos.push(fila);
        });

        var rut                = $("#rutS").val();
        var nombres            = $("#nombresS").val();
        var idpersona          = $("#idpersonaS").val();
        var tipo               = $("#tipoS").val();
        var calidadjuridica    = $("#cal_jur").val();
        var serviciounidad     = $("#ser_uni").val();
        var jornadalaboral     = $("#jor_lab").val();
        var fecha              = $("#fecha").val();

        if (idpersona != "" && nombres != "" && tipo != "" && serviciounidad != "" && jornadalaboral != ""){
            $.ajax({
            url: '<?=base_url()?>index.php/solicitud/add_solicitudX',
            method: 'post',
            data: {
                semana              : semana,
                autos               : autos,
                fecha               : fecha,
                rut                 : rut,
                idpersona           : idpersona,
                tipo                : tipo,
                calidadjuridica     : calidadjuridica,
                serviciounidad      : serviciounidad,
                jornadalaboral      : jornadalaboral
            },
            dataType: 'json'
            }).done(function(result) 
            {
                if (result > 0){
                    $('.alert').alert('close');
                    $('#modalS').modal('hide');
                    Swal.fire('Solicitud Añadida con exito', '', 'success')

                    $("#rutS").val('');
                    $("#nombresS").val('');
                    $("#idpersonaS").val('');
                    $("#tipoS").val('');
                    $("#cal_jur").val('');
                    $("#ser_uni").val('');
                    $("#jor_lab").val('');
                    $("#marca2").val('');
                    $("#modelo2").val('');
                    $("#patente2").val('');
                    $("input[name=btnradio]").prop("checked", false);
                    $("#Si").prop("checked", true);
                    $("#ObservacionAuto").val('');
                    $("#ObservacionAuto").hide(" #ObservacionAuto");
                    $("input[name=diasSemana]").prop("checked", false);
                    $("#miTabla2 > tbody").empty();

                    $('#rutS').removeClass('is-invalid');
                    $('#nombresS').removeClass('is-invalid');
                    $('#tipoS').removeClass('is-invalid');
                    $('#ser_uni').removeClass('is-invalid');
                    $('#jor_lab').removeClass('is-invalid');
                    

                    $('#tablaPersona').DataTable().ajax.reload();
                    $('#tablaMantenedor').DataTable().ajax.reload();
                }else if (result == 0){

                    $('.alert').alert('close');
                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder4')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert("Ya tiene un registro pendiente o autorizado", 'danger')

                }else{
                    $('.alert').alert('close');
                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert("ERROR INESPERADO", 'success')
                    setTimeout(function () {
                    $('.alert').alert('close');
                    }, 3000);

                    $('#tablaPersona').DataTable().ajax.reload();
                    $('#tablaMantenedor').DataTable().ajax.reload();
                }
                
                
            })

        }else{
            var alertPlaceholder = document.getElementById('liveAlertPlaceholder4')

            function alert(message, type) {
            var wrapper = document.createElement('div')
            wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

            alertPlaceholder.append(wrapper)
            
            }
            alert("Debe rellenar los campos obligatorios", 'danger')
            if (rut == ""){
                $('#rutS').addClass('is-invalid');
            }else{
                $('#rutS').removeClass('is-invalid');
            }

            if (nombres == ""){
                $('#nombresS').addClass('is-invalid');
            }else{
                $('#nombresS').removeClass('is-invalid');
            }

            if (tipo == ""){
                $('#tipoS').addClass('is-invalid');
            }else{
                $('#tipoS').removeClass('is-invalid');
            }

            if (serviciounidad == ""){
                $('#ser_uni').addClass('is-invalid');
            }else{
                $('#ser_uni').removeClass('is-invalid');
            }

            if (jornadalaboral == ""){
                $('#jor_lab').addClass('is-invalid');
            }else{
                $('#jor_lab').removeClass('is-invalid');
            }
            
            setTimeout(function () {
            $('.alert').alert('close');
            }, 3000);
        }
        
    });



    $('#botonAñadirVehiculo2').click(function(){

        var marca       = $("#marca2").val();
        var modelo      = $("#modelo2").val();
        var patente     = $("#patente2").val();
        var propietario = $("input[name='btnradio']:checked").val();
        var observacion = $("#ObservacionAuto").val();

        if (propietario == 1){
            propietario = "Si";
        }else{
            propietario = "No";
        }

        if (marca != "" && modelo != "") {

            $.ajax({
                url: '<?=base_url()?>index.php/solicitud/comprobar_patentes',
                method: 'post',
                data: {
                    patente           : patente
                },
                dataType: 'json'
            }).done(function(result) 
            {
                if (result == 1) {
                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder6')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert("Ya existe un vehiculo con esta patente", 'danger')
                    setTimeout(function () {
                    $('.alert').alert('close');
                    }, 5000);
                }else {
                    $('#miTabla2 > tbody:last-child').append('<tr><td class="marca">' + marca + '</td><td class="modelo">' + modelo + '</td><td class="patente">' + patente  + '</td><td class="propietario">' + propietario  + '</td><td class="observacion">' + observacion + '</td><td>' + '<button name="btnEliminar" class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar Vehiculo"><i class="fas fa-times"></i></button>' + '</td></tr>');
            
            
                    /*let autos = [];
                    document.querySelectorAll('#miTabla2> tbody tr').forEach(function(e){
                    let fila = {
                                    marca  : e.querySelector('.marca').innerText,
                                    modelo : e.querySelector('.modelo').innerText
                                    patente : e.querySelector('.patente').innerText
                                };
                    autos.push(fila);
                    });*/

                    $("#marca2").val('');
                    $("#modelo2").val('');
                    $("#patente2").val('');
                    $("input[name=btnradio]").prop("checked", false);
                    $("#Si").prop("checked", true);
                    $("#ObservacionAuto").val('');
                    $("#ObservacionAuto").hide(" #ObservacionAuto");
                } 
            })
        } else {
            var alertPlaceholder = document.getElementById('liveAlertPlaceholder6')

            function alert(message, type) {
            var wrapper = document.createElement('div')
            wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

            alertPlaceholder.append(wrapper)
            
            }
            alert('Debe rellenar los campos', 'danger')
            setTimeout(function () {
            $('.alert').alert('close');
            }, 3000);

        }
    })

    $("body").delegate( "[name=btnEliminar]", "click", function() { 

        $(this).closest('tr').remove();

    });

    //Quitar prestaciones de listado
    /*$("body").delegate('#tableListaPresta [name=btnQuitarPresta]', "click", function() {    
        var valor = $(this).attr("data-presta");
        $(this).closest('tr').remove();
    });*/

    $('#btnCerrarS').click(function(){
        $("#rutS").val('');
        $("#nombresS").val('');
        $("#idpersonaS").val('');
        $("#tipoS").val('');
        $("#cal_jur").val('');
        $("#ser_uni").val('');
        $("#jor_lab").val('');
        $("#marca2").val('');
        $("#modelo2").val('');
        $("#patente2").val('');
        $("input[name=btnradio]").prop("checked", false);
        $("#Si").prop("checked", true);
        $("#ObservacionAuto").val('');
        $("#ObservacionAuto").hide(" #ObservacionAuto");
        $("input[name=diasSemana]").prop("checked", false);
        $("#miTabla2 > tbody").empty();

        $('#rutS').removeClass('is-invalid');
        $('#nombresS').removeClass('is-invalid');
        $('#tipoS').removeClass('is-invalid');
        $('#ser_uni').removeClass('is-invalid');
        $('#jor_lab').removeClass('is-invalid');
    })

    $('#ser_uni').change(function(){ 
        $('#ser_uni').removeClass('is-invalid');
    })

    $('#jor_lab').change(function(){ 
        $('#jor_lab').removeClass('is-invalid');
    })

    $('#tipoS').change(function(){ 
        var tipo        = $("#tipoS").val();

        if(tipo == 3){
        $("#patente2").prop('disabled', true);
        }else{
            $("#patente2").prop('disabled', false);
        }
    });

    $('#tipoS').change(function(){ 
        var tipo        = $("#tipoS").val();
        var idpersona   = $("#idpersonaS").val();
        $('#tipoS').removeClass('is-invalid');
        $.ajax({
            url: '<?=base_url()?>index.php/solicitud/comprobar_solicitudes',
            method: 'post',
            data: {
                tipo                : tipo,
                idpersona           : idpersona
            },
            dataType: 'json'
        }).done(function(result) 
        {
            if (result == 1) {
                $('.alert').alert('close');
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder4')

                function alert(message, type) {
                var wrapper = document.createElement('div')
                wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                alertPlaceholder.append(wrapper)
                
                }
                alert("Ya tiene un registro pendiente o autorizado", 'danger')
                
            }else {
                $('.alert').alert('close');
            } 
            
        })
    });

})
</script>

<!-- SCRIPTS AÑADIR VEHICULO -->
<script>
$(document).ready(function() {
    $('#botonAñadirVehiculo').click(function(){ 
    var idsolicitud = $("#idsolicitud").val();
    var idpersona   = $("#idpersona").val();
    var tipo        = $("#tipo").val();
    var marca       = $("#marca").val();
    var modelo      = $("#modelo").val();
    var patente     = $("#patente").val();
    var propietario = $("input[name='btnradioVeh']:checked").val();
    var observacion = $("#ObservacionAutoVeh").val();

    if (idsolicitud != "" && idpersona != "" && tipo != "" && marca != "" && modelo != "") {

        $.ajax({
            url: '<?=base_url()?>index.php/solicitud/comprobar_patentes',
            method: 'post',
            data: {
                patente           : patente
            },
            dataType: 'json'
        }).done(function(result) 
        {
            if (result == 1) {
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder3')

                function alert(message, type) {
                var wrapper = document.createElement('div')
                wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                alertPlaceholder.append(wrapper)
                
                }
                alert("Ya existe un vehiculo con esta patente", 'danger')
                setTimeout(function () {
                $('.alert').alert('close');
                }, 5000);
            }else {
                $.ajax({
                    url: '<?=base_url()?>index.php/solicitud/add_vehiculo',
                    method: 'post',
                    data: {
                        idsolicitud : idsolicitud,
                        idpersona   : idpersona,
                        tipo        : tipo,
                        marca       : marca,
                        modelo      : modelo,
                        patente     : patente,
                        propietario : propietario,
                        observacion : observacion
                    },
                    dataType: 'json'
                }).done(function(result) 
                {
                    console.log(result);

                    $("#marca").val("");
                    $("#modelo").val("");
                    $("#patente").val("");
                    $("input[name=btnradioVeh]").prop("checked", false);
                    $("#SiVeh").prop("checked", true);
                    $("#ObservacionAutoVeh").val('');
                    $("#ObservacionAutoVeh").hide(" #ObservacionAutoVeh");

                    $.ajax({
                        url: '<?=base_url()?>index.php/solicitud/vehiculo',
                        method: 'post',
                        data: {
                            idsolicitud : idsolicitud,
                            tipo        : tipo
                        },
                        dataType: 'json'
                    }).done(function(data) 
                    {
                        $("#contenido").empty();
                        $.each(data, function(idx, opt) {
                            if(opt.propietario == 1){
                                opt.propietario = "Si";
                            }else{
                                opt.propietario = "No"
                            }
                        $('#contenido').append('<tr><td>' + opt.id + '</td><td>' + opt.rut + '</td><td>' + opt.marca + '</td><td>' + opt.modelo + '</td><td>' + opt.patente + '</td><td>' + opt.propietario  + '</td><td>' + opt.observacion + '</td><td>' + '<button id="btnDesactivarVehiculo" class="btn btn-danger" data-bs-toggle="tooltip" title="Desactivar Vehiculo" data-id="' + opt.id + '" data-idsolicitud="' + opt.idsolicitud + '" data-tipo="' + opt.tipo + '"><i class="fas fa-times"></i></button>' + '</td></tr>');
                        });
                    });

                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder3')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert('Vehiculo agregado a la solicitud con exito', 'success')
                    setTimeout(function () {
                    $('.alert').alert('close');
                    }, 3000);
                    
                })
            }
        })
    } else {
        var alertPlaceholder = document.getElementById('liveAlertPlaceholder3')

        function alert(message, type) {
        var wrapper = document.createElement('div')
        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

        alertPlaceholder.append(wrapper)
        
        }
        alert('Debe rellenar los campos', 'danger')
        setTimeout(function () {
        $('.alert').alert('close');
        }, 3000);

    }
    
});

$('#botonAñadirVehiculoSu').click(function(){ 
    var idsolicitud = $("#idSu").val();
    var idpersona   = $("#idpersonaSu").val();
    var tipo        = $("#tipoSu").val();
    var marca       = $("#marcaSu").val();
    var modelo      = $("#modeloSu").val();
    var patente     = $("#patenteSu").val();
    var propietario = $("input[name='btnradioSu']:checked").val();
    var observacion = $("#ObservacionAutoSu").val();

    if (idsolicitud != "" && idpersona != "" && tipo != "" && marca != "" && modelo != "") {

        $.ajax({
            url: '<?=base_url()?>index.php/solicitud/comprobar_patentes',
            method: 'post',
            data: {
                patente           : patente
            },
            dataType: 'json'
        }).done(function(result) 
        {
            if (result == 1) {
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder5')

                function alert(message, type) {
                var wrapper = document.createElement('div')
                wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                alertPlaceholder.append(wrapper)
                
                }
                alert("Ya existe un vehiculo con esta patente", 'danger')
                setTimeout(function () {
                $('.alert').alert('close');
                }, 5000);
            }else {
                $.ajax({
                    url: '<?=base_url()?>index.php/solicitud/add_vehiculo',
                    method: 'post',
                    data: {
                        idsolicitud : idsolicitud,
                        idpersona   : idpersona,
                        tipo        : tipo,
                        marca       : marca,
                        modelo      : modelo,
                        patente     : patente,
                        propietario : propietario,
                        observacion : observacion
                    },
                    dataType: 'json'
                }).done(function(result) 
                {
                    console.log(result);

                    $("#marcaSu").val("");
                    $("#modeloSu").val("");
                    $("#patenteSu").val("");
                    $("input[name=btnradioSu]").prop("checked", false);
                    $("#SiSu").prop("checked", true);
                    $("#ObservacionAutoSu").val('');
                    $("#ObservacionAutoSu").hide(" #ObservacionAutoSu");

                    $.ajax({
                        url: '<?=base_url()?>index.php/solicitud/vehiculo',
                        method: 'post',
                        data: {
                            idsolicitud : idsolicitud,
                            tipo        : tipo
                        },
                        dataType: 'json'
                    }).done(function(data) 
                    {
                        $("#contenido3").empty();
                        $.each(data, function(idx, opt) {
                            if(opt.propietario == 1){
                                opt.propietario = "Si";
                            }else{
                                opt.propietario = "No"
                            }
                        $('#contenido3').append('<tr><td>' + opt.id + '</td><td>' + opt.rut + '</td><td>' + opt.marca + '</td><td>' + opt.modelo + '</td><td>' + opt.patente + '</td><td>' + opt.propietario  + '</td><td>' + opt.observacion + '</td><td>' + '<button name="btnDesactivarVehiculoSu" class="btn btn-danger" data-bs-toggle="tooltip" title="Desactivar Vehiculo" data-id="' + opt.id + '" data-idsolicitud="' + opt.idsolicitud + '" data-tipo="' + opt.tipo + '"><i class="fas fa-times"></i></button>' + '</td></tr>');
                        });
                    });

                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder5')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert('Vehiculo agregado a la solicitud con exito', 'success')
                    setTimeout(function () {
                    $('.alert').alert('close');
                    }, 3000);
                    
                })
            }
        })
    } else {
        var alertPlaceholder = document.getElementById('liveAlertPlaceholder5')

        function alert(message, type) {
        var wrapper = document.createElement('div')
        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

        alertPlaceholder.append(wrapper)
        
        }
        alert('Debe rellenar los campos', 'danger')
        setTimeout(function () {
        $('.alert').alert('close');
        }, 3000);

    }
    
});


$(document).on('click', '#btnDesactivarVehiculo', function() {
    var id          = $(this).data("id");
    var idsolicitud = $(this).data("idsolicitud");
    var tipo        = $(this).data("tipo");
    $("#tipoVa").val(tipo);
    $("#idsolicitudVa").val(idsolicitud);
    $("#idVa").val(id);

    document.getElementById("nameVa").textContent = id;

    $('#anularVehiculo').modal('show');
});
$('#botonAnularVehiculo').click(function(){

    var id          = $("#idVa").val();
    var idsolicitud = $("#idsolicitudVa").val();
    var tipo        = $("#tipoVa").val();

    Swal.fire({
        title: '¿Esta seguro de anular este vehiculo?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {

            $.ajax({
                url: '<?=base_url()?>index.php/solicitud/delete_vehiculo',
                method: 'post',
                data: {
                    id          : id,
                    idsolicitud : idsolicitud,
                    tipo        : tipo
                },
                dataType: 'json'
            }).done(function(data) 
            {
                $("#contenido").empty();
                $.each(data, function(idx, opt) {
                    if(opt.propietario == 1){
                        opt.propietario = "Si";
                    }else{
                        opt.propietario = "No"
                    }
                $('#contenido').append('<tr><td>' + opt.id + '</td><td>' + opt.rut + '</td><td>' + opt.marca + '</td><td>' + opt.modelo + '</td><td>' + opt.patente + '</td><td>' + opt.propietario  + '</td><td>' + opt.observacion + '</td><td>' + '<button id="btnDesactivarVehiculo" class="btn btn-danger" data-bs-toggle="tooltip" title="Desactivar Vehiculo" data-id="' + opt.id + '" data-idsolicitud="' + opt.idsolicitud + '" data-tipo="' + opt.tipo + '"><i class="fas fa-times"></i></button>' + '</td></tr>');
                });
                Swal.fire('Vehiculo desactivado con exito', '', 'success')

                $('#anularVehiculo').modal('hide');

            })
        }else if (result.isDenied) {
        Swal.fire('Se cancelo la descativacion del vehiculo', '', 'info')
        $("#anularVehiculo").modal('hide');
        }
    })
});
});
</script>
<!-- SCRIPTS ELIMINAR VEHICULO -->
<script>
$(document).ready(function() {
    $("body").delegate( "[name=btnDesactivarVehiculoSu]", "click",function() {
        var id          = $(this).data("id");
        var idsolicitud = $(this).data("idsolicitud");
        var tipo        = $(this).data("tipo");
        Swal.fire({
            title: '¿Esta seguro de anular el vehiculo?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=base_url()?>index.php/solicitud/delete_vehiculo',
                    method: 'post',
                    data: {
                        id          : id,
                        idsolicitud : idsolicitud,
                        tipo        : tipo
                    },
                    dataType: 'json'
                }).done(function(data) 
                {
                    $("#contenido3").empty();
                    $.each(data, function(idx, opt) {
                        if(opt.propietario == 1){
                            opt.propietario = "Si";
                        }else{
                            opt.propietario = "No"
                        }
                    $('#contenido3').append('<tr><td>' + opt.id + '</td><td>' + opt.rut + '</td><td>' + opt.marca + '</td><td>' + opt.modelo + '</td><td>' + opt.patente + '</td><td>' + opt.propietario  + '</td><td>' + opt.observacion + '</td><td>' + '<button name="btnDesactivarVehiculoSu" class="btn btn-danger" data-bs-toggle="tooltip" title="Desactivar Vehiculo" data-id="' + opt.id + '" data-idsolicitud="' + opt.idsolicitud + '" data-tipo="' + opt.tipo + '"><i class="fas fa-times"></i></button>' + '</td></tr>');
                    });

                    Swal.fire('Vehiculo fue desactivado con exito', '', 'success')

                })

            } else if (result.isDenied) {
            Swal.fire('Se cancelo la descativacion del vehiculo', '', 'info')
            }
        })
    })
});
</script>
<!-- SCRIPTS MOSTRAR PATENTE SOLO CUANDO SON AUTOS Y MOTOS -->
<script>
    $('#tipo').change(function(){ 
        var tipo        = $("#tipo").val();

        if(tipo == 3){
            $("#show_patente").hide(" #show_patente");
        }else{
            $("#show_patente").show(" #show_patente");
        }
});
</script>
<!-- SCRIPTS ACTUALIZAR SOLICITUD -->
<script>
/*
$('#tipoSu').change(function(){ 
    var tipo        = $("#tipoSu").val();
    var idpersona   = $("#idpersonaSu").val();
    $.ajax({
        url: '<?=base_url()?>index.php/solicitud/comprobar_solicitudes',
        method: 'post',
        data: {
            tipo                : tipo,
            idpersona           : idpersona
        },
        dataType: 'json'
    }).done(function(result) 
    {
        if (result == 1) {
            
            Swal.fire('Ya tiene un registro pendiente o autorizado', '', 'error')
            
        } 
        
    })
});
*/
$('#estadoSu').change(function(){ 
    var estado = $("#estadoSu").val();
    var estadoE = $("#estadoSe").val();
    if (estado == 1){

        if (estadoE == 2){
            Swal.fire('No se puede autorizar una solicitud rechazada', '', 'error')
            $("#estadoSu").val(2);
        }else{
            $("#show_obau").show(" #show_obau");
            $("#show_tar").show(" #show_tar");
            $("#show_motivo").hide(" #show_motivo");
            $("#show_motivo2").hide(" #show_motivo2");
            $("#show_oban").hide(" #show_oban");
        }

        var parametrosA     = $("#recargarAuto").text();
        var parametrosM     = $("#recargarMoto").text();;
        var parametrosB     = $("#recargarBici").text();;

        var tipo                    = $("#tipoSu").val();
        var correlativolistaespera  = $("#correlativolistaesperaSa").val();

        if (parametrosA == 0 && tipo == 1 && correlativolistaespera > 0){
            $("#actualizarSolicitud").modal('hide'); 
            Swal.fire('No hay cupos disponibles', '', 'error')
        }else if (parametrosM == 0 && tipo == 2 && correlativolistaespera > 0){
            $("#actualizarSolicitud").modal('hide'); 
            Swal.fire('No hay cupos disponibles', '', 'error')
        }else if (parametrosB == 0 && tipo == 3 && correlativolistaespera > 0){
            $("#actualizarSolicitud").modal('hide'); 
            Swal.fire('No hay cupos disponibles', '', 'error')
        }else if (parametrosA != 0 && tipo == 1 && correlativolistaespera > 1){
            $("#actualizarSolicitud").modal('hide'); 
            Swal.fire('Debe autorizar al primero de la lista', '', 'error')
        }else if (parametrosM != 0 && tipo == 2 && correlativolistaespera > 1){
            $("#actualizarSolicitud").modal('hide'); 
            Swal.fire('Debe autorizar al primero de la lista', '', 'error')
        }else if (parametrosB != 0 && tipo == 3 && correlativolistaespera > 1){
            $("#actualizarSolicitud").modal('hide'); 
            Swal.fire('Debe autorizar al primero de la lista', '', 'error')
        }

    }else if(estado == 9){
        $("#show_oban").show(" #show_oban");
        $("#show_motivo").hide(" #show_motivo");
        $("#show_obau").hide(" #show_obau");
        $("#show_motivo2").hide(" #show_motivo2");
        $("#show_tar").hide(" #show_tar");
    }else if(estado == 2){
        if (estadoE == 1){
            Swal.fire('No se puede rechazar una solicitud autorizada', '', 'error')
            $("#estadoSu").val(1);
        }else{
            $("#show_motivo").show(" #show_motivo");
            $("#show_obau").hide(" #show_obau");
            $("#show_oban").hide(" #show_oban");
            $("#show_tar").hide(" #show_tar");
        }
    }else{
        if (estadoE == 1){
            Swal.fire('No se puede cambiar a pendiente siendo una solicitud autorizada', '', 'error')
            $("#estadoSu").val(1);
        }else if (estadoE == 2){
            Swal.fire('No se puede cambiar a pendiente siendo una solicitud rechazada', '', 'error')
            $("#estadoSu").val(2);
        }else{
            $("#show_obau").hide(" #show_obau");
            $("#show_motivo").hide(" #show_motivo");
            $("#show_motivo2").hide(" #show_motivo2");
            $("#show_oban").hide(" #show_oban");
            $("#show_tar").hide(" #show_tar");
        }
    }
    
});

$("body").delegate( "[name=btnAutorizarSolicitud]", "click", function() { 

    var parametrosA     = <? echo $parametrosA - $autoA; ?>;
    var parametrosM     = <? echo $parametrosM - $motoA; ?>;
    var parametrosB     = <? echo $parametrosB - $biciA; ?>;

    var tipo                    = $("#tipoSu").val();
    var estado                  = $("#estadoSu").val();
    var correlativolistaespera  = $("#correlativolistaesperaSa").val();

    if (parametrosA == 0 && tipo == 1 && estado == 0){
        $("#botonAutorizarSolicitud").prop('disabled', true); 
        Swal.fire('No hay cupos disponibles', '', 'error')
    }else if (parametrosM == 0 && tipo == 2 && estado == 0){
        $("#botonAutorizarSolicitud").prop('disabled', true); 
        Swal.fire('No hay cupos disponibles', '', 'error')
    }else if (parametrosB == 0 && tipo == 3 && estado == 0){
        $("#botonAutorizarSolicitud").prop('disabled', true); 
        Swal.fire('No hay cupos disponibles', '', 'error')
    }else{
        $("#autorizarSolicitud").modal('show');
        $("#botonAutorizarSolicitud").prop('disabled', false); 
        if (correlativolistaespera != 1) {
            $("#botonAutorizarSolicitud").prop('disabled', true);   
        }else{
            $("#botonAutorizarSolicitud").prop('disabled', false);
        }
    }

});
function agregaFormSu(d0, d1, d2, d3, d4, d5, d6, d7, d8 ,d9 ,d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20 ){

    var fechasolicitud = d3;
    var fechasolicitud = fechasolicitud.substring(0,10);

    var fechaautorizacion = d5;
    var fechaautorizacion = fechaautorizacion.substring(0,10);

    var fechaanulacion = d6;
    var fechaanulacion = fechaanulacion.substring(0,10);

    var fecharechazo = d7;
    var fecharechazo = fecharechazo.substring(0,10);

    var fechacrea = d14;
    var fechacrea = fechacrea.substring(0,10);

    var fechamod = d16;
    var fechamod = fechamod.substring(0,10);

    if (d9 == 'null'){
        $("#observacionesSu").val('');
        
    }else{
        $("#observacionesSu").val(d9);
    }

    if (d10 == 'null'){
        $("#motivorechazoSu").val('');
        $("#motivorechazoSr").val('');
    }else{
        $("#motivorechazoSu").val(d10);
        $("#motivorechazoSr").val(d10);
    }

    if (d18 == 'null'){
        $("#observacionanulaSu").val('');
        $("#observacionesSe").val('');
        
    }else{
        $("#observacionanulaSu").val(d18);
        $("#observacionesSe").val(d18);
    }

    if (d19 == 'null'){
        $("#observacionautorizaSu").val('');
        $("#observacionesSa").val('');
        
    }else{
        $("#observacionautorizaSu").val(d19);
        $("#observacionesSa").val(d19);
    }

    if (d20 == 'null'){
        $("#tarjeta").val('');
        
    }else{
        $("#tarjeta").val(d20);
    }
    $("#tipoWard").val(d2);

    $("#idSu").val(d0);
    $("#idpersonaSu").val(d1);
    $("#tipoSu").val(d2);
    $("#fechasolicitudSu").val(fechasolicitud);
    $("#estadoSu").val(d4);
    $("#fechaautorizacionSu").val(fechaautorizacion);
    $("#fechaanulacionSu").val(fechaanulacion);
    $("#fecharechazoSu").val(fecharechazo);
    $("#correlativolistaesperaSu").val(d8);
    $("#cal_jurSu").val(d11);
    $("#ser_uniSu").val(d12);
    $("#jor_labSu").val(d13);
    $("#fechacreaSu").val(fechacrea);
    $("#usucreaSu").val(d15);
    $("#fechamodSu").val(fechamod);
    $("#usumodSu").val(d17);

    $("#idSe").val(d0);
    $("#tipoSe").val(d2);
    $("#estadoSe").val(d4);
    $("#correlativolistaesperaSe").val(d8);
    
    document.getElementById("nameSe").textContent = d0;

    $("#idSa").val(d0);
    $("#tipoSa").val(d2);
    $("#correlativolistaesperaSa").val(d8);
    
    document.getElementById("nameSa").textContent = d0;

    $("#idsolicitud").val(d0);
    $("#idpersona").val(d1);
    $("#tipo").val(d2);

    $("#idSr").val(d0);
    $("#tipoSr").val(d2);
    $("#correlativolistaesperaSr").val(d8);
    
    document.getElementById("nameSr").textContent = d0;

    if (d2 == 1){
        document.getElementById("nameTipo").textContent = "Automovil";
    }else if (d2 == 2){
        document.getElementById("nameTipo").textContent = "Moto";
    }else if (d2 == 3){
        document.getElementById("nameTipo").textContent = "Bicicleta";
    }

    var idsolicitud = d0;
    var idpersona   = d1;
    var tipo        = d2;
    var estado      = d4;
    var usumod      = $("#usumodSu").val();
    var permiso     = <? echo $permiso; ?>;

    if (estado == 2) {
        $("#botonAñadirVehiculo").prop('disabled', true);
        $("#botonAñadirVehiculoSu").prop('disabled', true);
        $('.alert').alert('close');
        var alertPlaceholder = document.getElementById('liveAlertPlaceholder3')

        function alert(message, type) {
        var wrapper = document.createElement('div')
        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

        alertPlaceholder.append(wrapper)
        
        }
        alert('Esta solicitud esta rechazada, no se le pueden agregar vehiculos', 'danger')
        var alertPlaceholder = document.getElementById('liveAlertPlaceholder5')

        function alert(message, type) {
        var wrapper = document.createElement('div')
        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

        alertPlaceholder.append(wrapper)
        
        }
        alert('Esta solicitud esta rechazada, no se le pueden agregar vehiculos', 'danger')
        if(tipo == 3){
            $("#patente").prop('disabled', true);
            $("#patenteSu").prop('disabled', true);
        }else{
            $("#patente").prop('disabled', false);
            $("#patenteSu").prop('disabled', false);
        }
    }else{
        $('.alert').alert('close');
        if(tipo == 3){
            $("#patente").prop('disabled', true);
            $("#patenteSu").prop('disabled', true);
        }else{
            $("#patente").prop('disabled', false);
            $("#patenteSu").prop('disabled', false);
        }
        $("#botonAñadirVehiculo").prop('disabled', false);
        $("#botonAñadirVehiculoSu").prop('disabled', false);
    }
    

    if(permiso == 1){
        $("#estadoSu").prop('disabled', true);
        $("#tipoSu").prop('disabled', true);
        $("#tarjeta").prop('disabled', true);
    }else{
        $("#estadoSu").prop('disabled', false);
        $("#tipoSu").prop('disabled', false);
        $("#tarjeta").prop('disabled', false);
    }

    if (estado == 1){
        $("#show_obau").show(" #show_obau");
        $("#show_tar").show(" #show_tar");
        $("#show_motivo").hide(" #show_motivo");
        $("#show_motivo2").hide(" #show_motivo2");
        $("#show_oban").hide(" #show_oban");
    }else if(estado == 9){
        $("#show_oban").show(" #show_oban");
        $("#show_motivo").hide(" #show_motivo");
        $("#show_obau").hide(" #show_obau");
        $("#show_motivo2").hide(" #show_motivo2");
        $("#show_tar").hide(" #show_tar");
    }else if(estado == 2){
        $("#show_motivo").show(" #show_motivo");
        $("#show_motivo2").show(" #show_motivo2");
        $("#show_obau").hide(" #show_obau");
        $("#show_oban").hide(" #show_oban");
        $("#show_tar").hide(" #show_tar");
    }else{
        $("#show_obau").hide(" #show_obau");
        $("#show_motivo").hide(" #show_motivo");
        $("#show_motivo2").hide(" #show_motivo2");
        $("#show_oban").hide(" #show_oban");
        $("#show_tar").hide(" #show_tar");
    }

    $.ajax({
        url: '<?=base_url()?>index.php/solicitud/vehiculo',
        method: 'post',
        data: {
            idsolicitud : idsolicitud,
            tipo        : tipo
        },
        dataType: 'json'
    }).done(function(data) 
    {
        $("#contenido").empty();
        $.each(data, function(idx, opt) {
            if(opt.propietario == 1){
                opt.propietario = "Si";
            }else{
                opt.propietario = "No"
            }
        $('#contenido').append('<tr><td>' + opt.id + '</td><td>' + opt.rut + '</td><td>' + opt.marca + '</td><td>' + opt.modelo + '</td><td>' + opt.patente + '</td><td>' + opt.propietario  + '</td><td>' + opt.observacion + '</td><td>' + '<button id="btnDesactivarVehiculo" class="btn btn-danger" data-bs-toggle="tooltip" title="Desactivar Vehiculo" data-id="' + opt.id + '" data-idsolicitud="' + opt.idsolicitud + '" data-tipo="' + opt.tipo + '"><i class="fas fa-times"></i></button>' + '</td></tr>');
        });
    });

    $.ajax({
        url: '<?=base_url()?>index.php/solicitud/vehiculo',
        method: 'post',
        data: {
            idsolicitud : idsolicitud,
            tipo        : tipo
        },
        dataType: 'json'
    }).done(function(data) 
    {
        $("#contenido3").empty();
        $.each(data, function(idx, opt) {
            if(opt.propietario == 1){
                opt.propietario = "Si";
            }else{
                opt.propietario = "No"
            }
        $('#contenido3').append('<tr><td>' + opt.id + '</td><td>' + opt.rut + '</td><td>' + opt.marca + '</td><td>' + opt.modelo + '</td><td>' + opt.patente + '</td><td>' + opt.propietario  + '</td><td>' + opt.observacion + '</td><td>' + '<button name="btnDesactivarVehiculoSu" class="btn btn-danger" data-bs-toggle="tooltip" title="Desactivar Vehiculo" data-id="' + opt.id + '" data-idsolicitud="' + opt.idsolicitud + '" data-tipo="' + opt.tipo + '"><i class="fas fa-times"></i></button>' + '</td></tr>');
        });
    });

    $("input[name=diasSemanaSu]").prop("checked", false);

    $.ajax({
        url: '<?=base_url()?>index.php/solicitud/semana',
        method: 'post',
        data: {
            idpersona : idpersona
        },
        dataType: 'json'
    }).done(function(data) 
    {
        //console.log(data);
        $.each(data, function(idx, opt) {
            $("input[id=diasSemanaSu"+opt.dia+"]").prop("checked", true);
        })

    });
}

$('#botonActualizarSolicitud').click(function($permiso){ 

    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + now.getMinutes()).slice(-2);
    var second = ("0" + now.getSeconds()).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
    $("#fecha").val(today);

    var semana = [];
    $('input[name="diasSemanaSu"]:checked').each(function(){
        var dia= {};
        dia.codigo = $(this).val();
        semana.push(dia);
    });

    var id                      = $("#idSu").val();
    var idpersona               = $("#idpersonaSu").val();
    var tipo                    = $("#tipoSu").val();
    var tipoWard                = $("#tipoWard").val();
    var estado                  = $("#estadoSu").val();
    var fechaautorizacion       = $("#fechaautorizacionSu").val();
    var fechaanulacion          = $("#fechaanulacionSu").val();
    var fecharechazo            = $("#fecharechazoSu").val();
    var correlativolistaespera  = $("#correlativolistaesperaSu").val();
    var fecha                   = $("#fecha").val();
    var observaciones           = $("#observacionesSu").val();
    var observacionanula        = $("#observacionanulaSu").val();
    var observacionautoriza     = $("#observacionautorizaSu").val();
    var motivorechazo           = $("#motivorechazoSu").val();
    var calidadjuridica         = $("#cal_jurSu").val();
    var serviciounidad          = $("#ser_uniSu").val();
    var jornadalaboral          = $("#jor_labSu").val();
    var tarjeta                 = $("#tarjeta").val();

    var permiso                 = <? echo $permiso; ?>;

    if(permiso == 1 && estado == 1 || permiso == 1 && estado == 2){
        Swal.fire('No tiene los permisos para modificar esta solicitud', '', 'error')
    }else{

        Swal.fire({
            title: '¿Esta seguro de actualizar la solicitud?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=base_url()?>index.php/solicitud/update_solicitud',
                    method: 'post',
                    data: {
                        id                      : id,
                        idpersona               : idpersona,
                        tipo                    : tipo,
                        tipoWard                : tipoWard,
                        estado                  : estado,
                        fechaautorizacion       : fechaautorizacion,
                        fechaanulacion          : fechaanulacion,
                        fecharechazo            : fecharechazo,
                        correlativolistaespera  : correlativolistaespera,
                        fecha                   : fecha,
                        observaciones           : observaciones,
                        observacionanula        : observacionanula,
                        observacionautoriza     : observacionautoriza,
                        motivorechazo           : motivorechazo,
                        calidadjuridica         : calidadjuridica,
                        serviciounidad          : serviciounidad,
                        jornadalaboral          : jornadalaboral,
                        tarjeta                 : tarjeta,
                        semana                  : semana
                    },
                    dataType: 'json'
                }).done(function(result) 
                {
                        
                    if (result == 0){

                        $('.alert').alert('close');

                        Swal.fire("Ya tiene un registro pendiente o autorizado", '', 'error')

                    }else if (result == "danger"){
                        $('.alert').alert('close');

                        Swal.fire("Las solicitudes autorizadas no pueden cambiar su tipo de solicitud", '', 'error')
                    }else{
                        if (result == "Solicitud no puede actualizarse a este estado siendo 'Anulada'" || result == "Solicitud no puede actualizarse a este estado siendo 'Autorizada'" || result == "Solicitud no puede actualizarse a este estado siendo 'Rechazada'" || result == "Solicitud no se puede actualizar a este estado, porque no es el primero en la lista de espera" || result == "No tiene los permisos para realizar esta accion" || result == "No se puede actualizar el ESTADO y TIPO de la solicitud al mismo tiempo"){
                            Swal.fire(result, '', 'error')
                            $("#actualizarSolicitud").modal('hide');

                        }else{
                            Swal.fire(result, '', 'success')
                            $("#actualizarSolicitud").modal('hide');

                            $('#tablaPersona').DataTable().ajax.reload();
                            $('#tablaMantenedor').DataTable().ajax.reload();
                        }
                    }
                })
            }else if (result.isDenied) {
            Swal.fire('Se cancelo la actualizacion de la solicitud', '', 'info')
            }
        })
    }
});
</script>
<!-- SCRIPTS ANULAR SOLICITUD -->
<script>
$('#botonAnularSolicitud').click(function(){ 
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + now.getMinutes()).slice(-2);
    var second = ("0" + now.getSeconds()).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
    $("#fecha").val(today);
    
    var id                      = $("#idSe").val();
    var fecha                   = $("#fecha").val();
    var observaciones           = $("#observacionesSe").val();
    var correlativolistaespera  = $("#correlativolistaesperaSe").val();
    var tipo                    = $("#tipoSe").val();

    Swal.fire({
        title: '¿Esta seguro de anular la solicitud?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {
            $.ajax({
                url: '<?=base_url()?>index.php/solicitud/anular_solicitud',
                method: 'post',
                data: {
                    id                      : id,
                    fecha                   : fecha,
                    observaciones           : observaciones,
                    correlativolistaespera  : correlativolistaespera,
                    tipo                    : tipo
                },
                dataType: 'json'
            }).done(function(result) 
            {
                //console.log(result);
                if (result == 'Se anulo una solicitud Autorizada' || result == 'Solicitud Anulada' || result == 'Se anulo una solicitud Rechazada'){
                    Swal.fire(result, '', 'success')
                    $("#anularSolicitud").modal('hide');

                    $('#tablaPersona').DataTable().ajax.reload();
                    $('#tablaMantenedor').DataTable().ajax.reload();

                }else{
                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder2')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert(result, 'danger')
                    setTimeout(function () {
                    $('.alert').alert('close');
                    }, 5000);
                    $("#anularSolicitud").modal('hide');
                }
            })
            
        } else if (result.isDenied) {
            Swal.fire('Se cancelo la anulacion de la solicitud', '', 'info')
            $("#anularSolicitud").modal('hide');
        }
    })   
    
});
</script>
<!-- SCRIPTS AUTORIZAR SOLICITUD -->
<script>
$('#botonAutorizarSolicitud').click(function(){
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + now.getMinutes()).slice(-2);
    var second = ("0" + now.getSeconds()).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
    $("#fecha").val(today);

    var id                      = $("#idSa").val();
    var fecha                   = $("#fecha").val();
    var observaciones           = $("#observacionesSa").val();
    var correlativolistaespera  = $("#correlativolistaesperaSa").val();
    var tipo                    = $("#tipoSu").val();

    Swal.fire({
        title: '¿Esta seguro de autorizar la solicitud?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {
            $.ajax({
            url: '<?=base_url()?>index.php/solicitud/autorizar_solicitud',
            method: 'post',
            data: {
                id                      : id,
                fecha                   : fecha,
                observaciones           : observaciones,
                correlativolistaespera  : correlativolistaespera,
                tipo                    : tipo
            },
            dataType: 'json'
            }).done(function(result) 
            {
                if (result == 'Solicitud Autorizada' || result == 'Se autorizo una solicitud Rechazada'){
                    Swal.fire(result, '', 'success')
                    $("#autorizarSolicitud").modal('hide');

                    $('#tablaPersona').DataTable().ajax.reload();
                    $('#tablaMantenedor').DataTable().ajax.reload();

                }else{
                    Swal.fire(result, '', 'error')
                    $("#autorizarSolicitud").modal('hide');
                }
            })

        } else if (result.isDenied) {
            Swal.fire('Se cancelo la autorizacion de la solicitud', '', 'info')
            $("#autorizarSolicitud").modal('hide');
        }
    })
});
</script>
<!-- RECHAZAR SOLICITUD -->
<script>
$('#botonRechazarSolicitud').click(function(){ 
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + now.getMinutes()).slice(-2);
    var second = ("0" + now.getSeconds()).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
    $("#fecha").val(today);
    
    var id                      = $("#idSr").val();
    var fecha                   = $("#fecha").val();
    var tipo                    = $("#tipoSr").val();
    var motivorechazo           = $("#motivorechazoSr").val();
    var correlativolistaespera  = $("#correlativolistaesperaSr").val();

    Swal.fire({
        title: '¿Esta seguro de rechazar la solicitud?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {
            $.ajax({
                url: '<?=base_url()?>index.php/solicitud/rechazar_solicitud',
                method: 'post',
                data: {
                    id                      : id,
                    fecha                   : fecha,
                    tipo                    : tipo,
                    motivorechazo           : motivorechazo,
                    correlativolistaespera  : correlativolistaespera
                },
                dataType: 'json'
            }).done(function(result) 
            {
                console.log(result);
                if (result == 'Solicitud Rechazada' || result == 'Se rechazo una solicitud Autorizada'){
                    Swal.fire(result, '', 'success')
                    $("#rechazarSolicitud").modal('hide');

                    $('#tablaPersona').DataTable().ajax.reload();
                    $('#tablaMantenedor').DataTable().ajax.reload();

                }else{
                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder2')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert(result, 'danger')
                    setTimeout(function () {
                    $('.alert').alert('close');
                    }, 5000);
                    $("#rechazarSolicitud").modal('hide');
                }
            })
        } else if (result.isDenied) {
            Swal.fire('Se cancelo el rechazo de la solicitud', '', 'info')
            $("#rechazarSolicitud").modal('hide');
        }
    })
});
</script>
<!-- SCRIPTS BUSCAR POR RUT -->
<script> 
$("#botonBuscarRut").click(function() {
    
    var rut = $("#rut").val();
    //console.log(rut);
    if(rut != "")
    {
        $.ajax({
            url: '<?=base_url() ?>index.php/solicitud/search_persona',
            method: 'post',
            data: {
                rut     : rut
            },
            success: function(valor) {
                if (valor!="")
                {
                    $("#nombres").val(valor);
                    $.ajax({
                        url: '<?=base_url() ?>index.php/solicitud/add_persona',
                        method: 'post',
                        data: {
                            rut     : rut
                        },
                        success: function(valor) {
                            console.log(valor)
                            if (valor == '"Persona ya existe"'){
                                $.ajax({
                                    url: '<?=base_url() ?>index.php/solicitud/search_persona_id',
                                    dataType: 'json',
                                    type: 'post',
                                    data: {
                                        rut     : rut
                                    },
                                    success: function(valores) {
                                        for (var v in valores) {        
                                            id       = valores[v].id;
                                            estado   = valores[v].estado;
                                        }

                                        $("#idpersona").val(id);
                                        //console.log(id);
                                        var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                                        function alert(message, type) {
                                        var wrapper = document.createElement('div')
                                        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                                        alertPlaceholder.append(wrapper)
                                        
                                        }
                                        alert('Persona encontrada', 'success')

                                        setTimeout(function () {
                                        $('.alert').alert('close');
                                        }, 3000);
                                        
                                    },
                                    error: function(valores){
                                        alert("ERROR");
                                    }
                                });
                            }else{
                                $("#idpersona").val(valor);
                                //console.log(valor);
                                var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                                function alert(message, type) {
                                var wrapper = document.createElement('div')
                                wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                                alertPlaceholder.append(wrapper)
                                
                                }
                                alert('Persona encontrada y agregada', 'success')
                                setTimeout(function () {
                                $('.alert').alert('close');
                                }, 3000);
                            }
                            
                        },
                        error: function(valor){
                            //console.log(valor);
                        }
                    });
                }
                else
                {
                    $("#nombres").val("");
                    $("#idpersona").val("");
                    $("#rut").val("");
                    //console.log(valor);
                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

                    function alert(message, type) {
                    var wrapper = document.createElement('div')
                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                    alertPlaceholder.append(wrapper)
                    
                    }
                    alert('La persona ingresada no es funcionario', 'danger')
                    setTimeout(function () {
                    $('.alert').alert('close');
                    }, 5000);
                    $('#tablaMantenedor').DataTable().search($("#rut").val()).draw();
                    $('#tablaPersona').DataTable().search($("#rut").val()).draw();
                }
            },
            error: function(valor){
                console.log(valor);
            }
        });
    }else{
        var alertPlaceholder = document.getElementById('liveAlertPlaceholder')

        function alert(message, type) {
        var wrapper = document.createElement('div')
        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

        alertPlaceholder.append(wrapper)
        
        }
        alert('Debe ingresar un rut valido', 'danger')
        setTimeout(function () {
        $('.alert').alert('close');
        }, 3000);
    }
    
})
$("body").delegate( "[name=botonBuscarRutS]", "click",function() {
    var rut = $("#rutS").val();
    //console.log(rut);
    $.ajax({
        url: '<?=base_url() ?>index.php/solicitud/search_persona',
        method: 'post',
        data: {
            rut     : rut
        },
        success: function(valor) {
            if (valor!="" && rut != "")
            {
                $("#nombresS").val(valor);
                $.ajax({
                    url: '<?=base_url() ?>index.php/solicitud/add_persona',
                    method: 'post',
                    data: {
                        rut     : rut
                    },
                    success: function(valor) {
                        console.log(valor)
                        if (valor == '"Persona ya existe"'){
                            $.ajax({
                                url: '<?=base_url() ?>index.php/solicitud/search_persona_id',
                                dataType: 'json',
                                type: 'post',
                                data: {
                                    rut     : rut
                                },
                                success: function(valores) {
                                    for (var v in valores) {        
                                        id       = valores[v].id;
                                        estado   = valores[v].estado;
                                    }

                                    $("#idpersonaS").val(id);
                                    console.log(id);
                                    var alertPlaceholder = document.getElementById('liveAlertPlaceholder4')

                                    function alert(message, type) {
                                    var wrapper = document.createElement('div')
                                    wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                                    alertPlaceholder.append(wrapper)
                                    
                                    }
                                    alert('Persona encontrada', 'success')

                                    setTimeout(function () {
                                    $('.alert').alert('close');
                                    }, 3000);

                                    var idpersona = id;

                                    $.ajax({
                                        url: '<?=base_url()?>index.php/solicitud/semana',
                                        method: 'post',
                                        data: {
                                            idpersona : idpersona
                                        },
                                        dataType: 'json'
                                    }).done(function(data) 
                                    {
                                        //console.log(data);
                                        $.each(data, function(idx, opt) {
                                            $("input[id=dia"+opt.dia+"]").prop("checked", true);
                                        })

                                    });

                                    $('#rutS').removeClass('is-invalid');
                                    $('#nombresS').removeClass('is-invalid');
                                    
                                },
                                error: function(valores){
                                    alert("ERROR");
                                }
                            });
                        }else{
                            $("#idpersonaS").val(valor);
                            console.log(valor);
                            var alertPlaceholder = document.getElementById('liveAlertPlaceholder4')

                            function alert(message, type) {
                            var wrapper = document.createElement('div')
                            wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                            alertPlaceholder.append(wrapper)
                            
                            }
                            alert('Persona encontrada y agregada', 'success')
                            setTimeout(function () {
                            $('.alert').alert('close');
                            }, 3000);

                            $('#rutS').removeClass('is-invalid');
                            $('#nombresS').removeClass('is-invalid');
                        }
                        
                    },
                    error: function(valor){
                        console.log(valor);
                    }
                });
            }
            else
            {
                $("#nombresS").val("");
                $("#idpersonaS").val("");
                $("#rutS").val("");
                console.log(valor);
                var alertPlaceholder = document.getElementById('liveAlertPlaceholder4')

                function alert(message, type) {
                var wrapper = document.createElement('div')
                wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

                alertPlaceholder.append(wrapper)
                
                }
                alert('La persona ingresada no es funcionario', 'danger')
                setTimeout(function () {
                $('.alert').alert('close');
                }, 5000);

                $('#rutS').addClass('is-invalid');
                $('#nombresS').addClass('is-invalid');
            }
        },
        error: function(valor){
            console.log(valor);
        }
    });
})
</script>
<!-- SCRIPTS INSERTAR FECHA DEL DIA -->
<script>
$( document ).ready(function() {

    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + now.getMinutes()).slice(-2);
    var second = ("0" + now.getSeconds()).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
    $("#fecha").val(today);
});
</script>
<!-- DATATABLE MANTENEDOR -->
<script>
$(document).ready( function () {
    $('#tablaMantenedor').DataTable({
        'info': true,
        "dom": 'lrt',
        "pageLength": 8,
        "order": [[1, 'asc'],[ 6, 'desc' ],[ 0, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        },

        'ajax': {
            "url": '<?=base_url() ?>index.php/solicitud/persona_mantenedor',
            "type": "POST",
            dataSrc: ''
        },
        'columns':[
            {data: 'rut'},
            {data: 'tipo'},
            {data: 'fechasolicitud'},
            {data: 'estado'},
            {data: 'fechaautorizacion'},
            {data: 'fecharechazo'},
            {data: 'correlativolistaespera'},
            {"orderable": true,
                render: function(data, type, row){
                    return  '<button name="btnActualizarSolicitud" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actualizarSolicitud" data-bs-toggle="tooltip" title="Editar Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-pencil-alt"></i></button>'+
                            '<button name="btnAnularSolicitud" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#anularSolicitud" data-bs-toggle="tooltip" title="Anular Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-exclamation-triangle"></i></button>'+
                            '<button name="btnAñadirVehiculo" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#añadirVehiculo" data-bs-toggle="tooltip" title="Añadir Vehiculo" data-idpersona="'+row.idpersona+'" data-estado="'+row.estado+'" data-idsolicitud="'+row.id+'" data-tipo="'+row.tipo+'" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-car-side"></i></button>';
                }
            }
        ],
        'columnDefs':[{
            "targets": [1],
            "data": "tipo",
            "render": function(data,type,row) {
                if (data == 1){
                    return "AutoMovil";
                }else if (data == 2){
                    return "Moto";
                }else if (data == 3){
                    return "Bicicleta";
                }
            }
        },{
            "targets": [3],
            "data": "estado",
            "render": function(data,type,row) {
                if (data == 0){
                    return "<span class='badge rounded-pill bg-primary'>Pendiente</span>";
                }else if (data == 1){
                    return "<span class='badge rounded-pill bg-success'>Autorizado</span>";
                }else if (data == 2){
                    return "<span class='badge rounded-pill bg-danger'>Rechazado</span>";
                }
            }
        },{
            "targets": [0],
            "data": "estado",
            "render": function(data,type,row) {
                return "<span style='color:#006699'><i class='fas fa-user'></i> &nbsp;"+data+"</span><br>"+
                        "<span style='color:#555'><i class='fas fa-file'></i> &nbsp;"+row.id+"</span>";
            }
        },{
            "targets": [2],
            "data": "fechasolicitud",
            "render": function(data,type,row) {
                if (data == null){
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp; Sin Fecha</span>";
                }else{
                    var anno = data.substring(0,4);
                    var mes = data.substring(5,7);
                    var dia = data.substring(8,10);
                    var hms = data.substring(11,19);
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp;"+dia+"-"+mes+"-"+anno+" "+hms+"</span>";
                }
            }
        },{
            "targets": [4],
            "data": "fechaautorizacion",
            "render": function(data,type,row) {
                if (data == null){
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp; Sin Fecha</span>";
                }else{
                    var anno = data.substring(0,4);
                    var mes = data.substring(5,7);
                    var dia = data.substring(8,10);
                    var hms = data.substring(11,19);
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp;"+dia+"-"+mes+"-"+anno+" "+hms+"</span>";
                }
            }
        },{
            "targets": [5],
            "data": "fecharechazo",
            "render": function(data,type,row) {
                if (data == null){
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp; Sin Fecha</span>";
                }else{
                    var anno = data.substring(0,4);
                    var mes = data.substring(5,7);
                    var dia = data.substring(8,10);
                    var hms = data.substring(11,19);
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp;"+dia+"-"+mes+"-"+anno+" "+hms+"</span>";
                }
            }
        },{
            "targets": [6],
            "data": "correlativolistaespera",
            "render": function(data,type,row) {
                if (row.estado == 0){
                    return "<span style='color:#555'>"+data+"</span>";
                }else if (row.estado == 1){
                    return "<span style='color:#2C6F31'><i class='fas fa-check-circle'></i></span>";
                }else if (row.estado == 2){
                    return "<span style='color:#7F0E0E'><i class='fas fa-times-circle'></i></span>";
                }
            }
        }]
    })

    $('#botonBuscarRut').on( 'keyup click', function () {
        $('#tablaMantenedor').DataTable().search($('#rut').val()).draw();
    });

    $('#refresh').on( 'keyup click', function () {
        $("#rut").val("");
        $("#nombres").val("");
        $('#tablaMantenedor').DataTable().search($("#rut").val()).draw();
    });
});    
</script>

<!-- DATATABLE ADMIN -->
<script>
$(document).ready( function () {
    $('#tablaPersona').DataTable({
        'info': true,
        "dom": 'lrt',
        "pageLength": 8,
        "order": [[1, 'asc'],[ 6, 'desc' ],[ 3, 'desc' ],[ 0, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        },

        'ajax': {
            "url": '<?=base_url() ?>index.php/solicitud/persona',
            "type": "POST",
            dataSrc: ''
        },
        'columns':[
            {data: 'rut'},
            {data: 'tipo'},
            {data: 'fechasolicitud'},
            {data: 'estado'},
            {data: 'fechaautorizacion'},
            {data: 'fecharechazo'},
            {data: 'correlativolistaespera'},
            {"orderable": true,
                render: function(data, type, row){
                    if (row.estado == 1 || row.estado == 2) {
                        return  '<button name="btnActualizarSolicitud" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actualizarSolicitud" data-bs-toggle="tooltip" title="Editar Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-pencil-alt"></i></button>'+
                                '<button name="btnAnularSolicitud" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#anularSolicitud" data-bs-toggle="tooltip" title="Anular Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-exclamation-triangle"></i></button>'+
                                '<button name="btnAñadirVehiculo" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#añadirVehiculo" data-bs-toggle="tooltip" title="Añadir Vehiculo" data-idpersona="'+row.idpersona+'" data-estado="'+row.estado+'" data-idsolicitud="'+row.id+'" data-tipo="'+row.tipo+'" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-car-side"></i></button>';
                    }else{
                        return  '<button name="btnActualizarSolicitud" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actualizarSolicitud" data-bs-toggle="tooltip" title="Editar Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-pencil-alt"></i></button>'+
                                '<button name="btnAnularSolicitud" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#anularSolicitud" data-bs-toggle="tooltip" title="Anular Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-exclamation-triangle"></i></button>'+
                                '<button id="btnRechazarSolicitud" name="btnRechazarSolicitud" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rechazarSolicitud" data-bs-toggle="tooltip" title="Rechazar Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-times"></i></button>'+
                                '<button id="btnAutorizarSolicitud" name="btnAutorizarSolicitud" type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Autorizar Solicitud" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-check"></i></button>'+
                                '<button name="btnAñadirVehiculo" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#añadirVehiculo" data-bs-toggle="tooltip" title="Añadir Vehiculo" data-idpersona="'+row.idpersona+'" data-estado="'+row.estado+'" data-idsolicitud="'+row.id+'" data-tipo="'+row.tipo+'" onclick="agregaFormSu(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.fechasolicitud+'\',\''+row.estado+'\',\''+row.fechaautorizacion+'\',\''+row.fechaanulacion+'\',\''+row.calidadjuridica+'\',\''+row.serviciounidad+'\',\''+row.jornadalaboral+'\',\''+row.fecharechazo+'\',\''+row.correlativolistaespera+'\',\''+row.observaciones+'\',\''+row.motivorechazo+'\',\''+row.fechacrea+'\',\''+row.usucrea+'\',\''+row.fechamod+'\',\''+row.usumod+'\',\''+row.observacionanula+'\',\''+row.observacionautoriza+'\',\''+row.tarjeta+'\')"><i class="fas fa-car-side"></i></button>';
                    }
                }
            }
        ],
        'columnDefs':[{
            "targets": [1],
            "data": "tipo",
            "render": function(data,type,row) {
                if (data == 1){
                    return "AutoMovil";
                }else if (data == 2){
                    return "Moto";
                }else if (data == 3){
                    return "Bicicleta";
                }
            }
        },{
            "targets": [3],
            "data": "estado",
            "render": function(data,type,row) {
                if (data == 0){
                    return "<span class='badge rounded-pill bg-primary'>Pendiente</span>";
                }else if (data == 1){
                    return "<span class='badge rounded-pill bg-success'>Autorizado</span>";
                }else if (data == 2){
                    return "<span class='badge rounded-pill bg-danger'>Rechazado</span>";
                }
            }
        },{
            "targets": [0],
            "data": "rut",
            "render": function(data,type,row) {
                return  "<span style='color:#006699'><i class='fas fa-user'></i> &nbsp;"+data+"</span><br>"+
                        "<span style='color:#555'><i class='fas fa-file'></i> &nbsp;"+row.id+"</span>";
            }
        },{
            "targets": [2],
            "data": "fechasolicitud",
            "render": function(data,type,row) {
                if (data == null){
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp; Sin Fecha</span>";
                }else{
                    var anno = data.substring(0,4);
                    var mes = data.substring(5,7);
                    var dia = data.substring(8,10);
                    var hms = data.substring(11,19);
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp;"+dia+"-"+mes+"-"+anno+" "+hms+"</span>";
                }
            }
        },{
            "targets": [4],
            "data": "fechaautorizacion",
            "render": function(data,type,row) {
                if (data == null){
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp; Sin Fecha</span>";
                }else{
                    var anno = data.substring(0,4);
                    var mes = data.substring(5,7);
                    var dia = data.substring(8,10);
                    var hms = data.substring(11,19);
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp;"+dia+"-"+mes+"-"+anno+" "+hms+"</span>";
                }
            }
        },{
            "targets": [5],
            "data": "fecharechazo",
            "render": function(data,type,row) {
                if (data == null){
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp; Sin Fecha</span>";
                }else{
                    var anno = data.substring(0,4);
                    var mes = data.substring(5,7);
                    var dia = data.substring(8,10);
                    var hms = data.substring(11,19);
                    return "<span style='color:#555'><i class='fas fa-calendar-alt'></i> &nbsp;"+dia+"-"+mes+"-"+anno+" "+hms+"</span>";
                }
            }
        },{
            "targets": [6],
            "data": "correlativolistaespera",
            "render": function(data,type,row) {
                if (row.estado == 0){
                    return "<span style='color:#555'>"+data+"</span>";
                }else if (row.estado == 1){
                    return "<span style='color:#2C6F31'><i class='fas fa-check-circle'></i></span>";
                }else if (row.estado == 2){
                    return "<span style='color:#7F0E0E'><i class='fas fa-times-circle'></i></span>";
                }
            }
        }]
    })

    $('#botonBuscarRut').on( 'keyup click', function () {
        $('#tablaPersona').DataTable().search($('#rut').val()).draw();
    });

    $('#refresh').on( 'keyup click', function () {
        $("#rut").val("");
        $("#nombres").val("");
        $('#tablaPersona').DataTable().search($("#rut").val()).draw();
    });
});    
</script>

