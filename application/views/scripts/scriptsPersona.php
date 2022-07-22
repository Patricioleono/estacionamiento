<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.5.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.dataTables.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/dataTables.bootstrap5.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/sweetalert2.all.min.js"); ?>"></script>
<!-- SCRIPTS BUSCAR POR RUT -->
<script>
$('#botonBuscarRut').click(function() {
    var rut = $("#rut").val();
    //console.log(rut);
    if (rut != ""){
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
                            //console.log(valor)
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

                                $('#tablaP').DataTable().ajax.reload();

                                setTimeout(function () {
                                $('.alert').alert('close');
                                }, 3000);
                            }
                            
                        },
                        error: function(valor){
                            console.log(valor);
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
                    $('#tablaP').DataTable().search($("#rut").val()).draw();
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
        }, 5000);
    }
    
})
</script>
<!-- SCRIPTS ACTUALIZAR PERSONA -->
<script>
function agregaFormP(d0, d1, d2){

    $("#idu").val(d0);
    $("#rutu").val(d1);
    $("#estadou").val(d2);

    $("#ide").val(d0);
    document.getElementById("rute").textContent = d1;
}

$('#botonActualizarPersona').click(function(){ 
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + now.getMinutes()).slice(-2);
    var second = ("0" + now.getSeconds()).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
    $("#fecha").val(today);

    var id          = $("#idu").val();
    var rut         = $("#rutu").val();
    var estado      = $("#estadou").val();
    var fecha       = $("#fecha").val();

    Swal.fire({
        title: '¿Esta seguro de actualizar esta persona?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {

            $.ajax({
                url: '<?=base_url()?>index.php/persona/update_persona',
                method: 'post',
                data: {
                    id          : id,
                    rut         : rut,
                    estado      : estado,
                    fecha       : fecha
                },
                dataType: 'json'
            }).done(function(result) 
            {
                Swal.fire('Persona actualizada con exito - RUT: ' + rut, '', 'success')
                
                $("#actualizarPersona").modal('hide');

                $('#tablaP').DataTable().ajax.reload();
            
            })
        }else if (result.isDenied) {
        Swal.fire('Se cancelo la actualizacion de la persona', '', 'info')
        $("#actualizarPersona").modal('hide');
        }
    })
});
</script>
<!-- SCRIPTS ELIMINAR PERSONA -->
<script>

$('#botonEliminarPersona').click(function(){ 
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + now.getMinutes()).slice(-2);
    var second = ("0" + now.getSeconds()).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hour)+":"+(minute)+":"+(second);
    $("#fecha").val(today);

    var id      = $("#ide").val();
    var fecha   = $("#fecha").val();
    Swal.fire({
        title: '¿Esta seguro de anular esta persona?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {
            $.ajax({
                url: '<?=base_url()?>index.php/persona/delete_persona',
                method: 'post',
                data: {
                    id      : id,
                    fecha   : fecha
                },
                dataType: 'json'
            }).done(function(result) 
            {
                Swal.fire('Persona fue anulada con exito', '', 'success')
                $("#eliminarPersona").modal('hide');

                $('#tablaP').DataTable().ajax.reload();
            })
        }else if (result.isDenied) {
        Swal.fire('Se cancelo la descativacion de la persona', '', 'info')
        $("#eliminarPersona").modal('hide');
        }
    })
});
</script>

<script>
$(document).ready( function () {
    $('#tablaP').DataTable({
        'info': true,
        "dom": 'lrt',
        "pageLength": 10,
        "order": [[0, 'asc']],
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
            "url": '<?=base_url() ?>index.php/persona/persona',
            "type": "POST",
            dataSrc: ''
        },
        'columns':[
            {data: 'id'},
            {data: 'rut'},
            {data: 'estado'},
            {"orderable": true,
                render: function(data, type, row){
                    return  '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actualizarPersona" data-bs-toggle="tooltip" title="Editar Persona" onclick="agregaFormP(\''+row.id+'\',\''+row.rut+'\',\''+row.estado+'\')"><i class="fas fa-pencil-alt"></i></button>'+
                            '<button id="btnEliminarPersona" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarPersona" data-bs-toggle="tooltip" title="Anular Persona" onclick="agregaFormP(\''+row.id+'\',\''+row.rut+'\',\''+row.estado+'\')"><i class="fas fa-times"></i></button>';
                }
            }
        ],
        'columnDefs':[{
            "targets": [2],
            "data": "estado",
            "render": function(data,type,row) {
                if (data == 1){
                    return "<span class='badge rounded-pill bg-primary'>Activo</span>";
                }else{
                    return "<span class='badge rounded-pill bg-danger'>Inactivo</span>";
                }
            }
        },{
            "targets": [1],
            "data": "rut",
            "render": function(data,type,row) {
                return "<span style='color:#006699'><i class='fas fa-user'></i> &nbsp;"+data+"</span>";
            }
        }]
    })

    $('#botonBuscarRut').on( 'keyup click', function () {
        $('#tablaP').DataTable().search($('#rut').val()).draw();
    });
    $('#refresh').on( 'keyup click', function () {
        $("#rut").val("");
        $("#nombres").val("");
        $('#tablaP').DataTable().search($("#rut").val()).draw();
    });
});    
</script> 

</html>