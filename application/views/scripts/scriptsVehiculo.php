<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.5.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.dataTables.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/dataTables.bootstrap5.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/sweetalert2.all.min.js"); ?>"></script>
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
    $("body").delegate( "[name=btnradio]", "change", function() { 
    var Si        = document.getElementById('Si').checked;
    var No        = document.getElementById('No').checked;

    if(Si){
        $("#show_observacion").hide(" #show_observacion");
    }else if(No){
        $("#show_observacion").show(" #show_observacion");
    }
});
</script>
<!-- SCRIPTS ACTUALIZAR VEHICULO -->
<script>
function agregaForm(d0, d1, d2, d3, d4, d5, d6, d7, d8){

    $("#idu").val(d0);
    $("#idpersonau").val(d1);
    $("#tipou").val(d2);
    $("#marcau").val(d3);
    $("#modelou").val(d4);
    $("#patenteu").val(d5);
    $("#estadou").val(d6);
    if (d7 == 1){
        $("#Si").prop("checked", true);
        $("#show_observacion").hide(" #show_observacion");
    }else{
        $("#No").prop("checked", true);
        $("#show_observacion").show(" #show_observacion");
    }
    $("#observacion").val(d8);

    $("#ide").val(d0);
    document.getElementById("nameVe").textContent = d0;
}

$('#botonActualizarVehiculo').click(function(){ 
    var id          = $("#idu").val();
    var idpersona   = $("#idpersonau").val();
    var tipo        = $("#tipou").val();
    var marca       = $("#marcau").val();
    var modelo      = $("#modelou").val();
    var patente     = $("#patenteu").val();
    var estado      = $("#estadou").val();
    var propietario = $("input[name='btnradio']:checked").val();
    var observacion = $("#observacion").val();

    Swal.fire({
        title: '¿Esta seguro de actualizar este vehiculo?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {

            $.ajax({
                url: '<?=base_url()?>index.php/vehiculo/update_vehiculo',
                method: 'post',
                data: {
                    id          : id,
                    idpersona   : idpersona,
                    tipo        : tipo,
                    marca       : marca,
                    modelo      : modelo,
                    patente     : patente,
                    estado      : estado,
                    propietario : propietario,
                    observacion : observacion
                },
                dataType: 'json'
            }).done(function(result) 
            {
                Swal.fire('Vehiculo actualizado con exito', '', 'success')
                $("#actualizarVehiculo").modal('hide');

                $('#tablaV').DataTable().ajax.reload();

            })
        }else if (result.isDenied) {
        Swal.fire('Se cancelo la actualizacion del vehiculo', '', 'info')
        $("#actualizarVehiculo").modal('hide');
        }
    })
});
</script>
<!-- SCRIPTS ELIMINAR VEHICULO -->
<script>

$('#botonEliminarVehiculo').click(function(){ 
    var id = $("#ide").val();

    Swal.fire({
        title: '¿Esta seguro de anular este vehiculo?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        
        if (result.isConfirmed) {

            $.ajax({
                url: '<?=base_url()?>index.php/vehiculo/delete_vehiculo',
                method: 'post',
                data: {
                    id          : id
                },
                dataType: 'json'
            }).done(function(result) 
            {
                Swal.fire('Vehiculo desactivado con exito', '', 'success')

                $('#tablaV').DataTable().ajax.reload();
                $("#eliminarVehiculo").modal('hide');

            })
        }else if (result.isDenied) {
        Swal.fire('Se cancelo la descativacion del vehiculo', '', 'info')
        $("#eliminarVehiculo").modal('hide');
        }
    })
});
</script>

<script>
$(document).ready( function () {
    $('#tablaV').DataTable({
        'info': true,
        "dom": 'lrt',
        "pageLength": 10,
        "order": [[6, 'asc'],[1, 'asc'],[0,'asc']],
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
            "url": '<?=base_url() ?>index.php/vehiculo/vehiculo',
            "type": "POST",
            dataSrc: ''
        },
        'columns':[
            {data: 'rut'},
            {data: 'tipo'},
            {data: 'marca'},
            {data: 'modelo'},
            {data: 'patente'},
            {data: 'propietario'},
            {data: 'estado'},
            {"orderable": true,
                render: function(data, type, row){
                    return  '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actualizarVehiculo" data-bs-toggle="tooltip" title="Editar Vehiculo" onclick="agregaForm(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.marca+'\',\''+row.modelo+'\',\''+row.patente+'\',\''+row.estado+'\',\''+row.propietario+'\',\''+row.observacion+'\')"><i class="fas fa-pencil-alt"></i></button>'+
                            '<button id="btnEliminarVehiculo" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarVehiculo" data-bs-toggle="tooltip" title="Anular Vehiculo" onclick="agregaForm(\''+row.id+'\',\''+row.idpersona+'\',\''+row.tipo+'\',\''+row.marca+'\',\''+row.modelo+'\',\''+row.patente+'\',\''+row.estado+'\',\''+row.propietario+'\',\''+row.observacion+'\')"><i class="fas fa-times"></i></button>';
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
            "targets": [5],
            "data": "propietario",
            "render": function(data,type,row) {
                if (data == 1){
                    return "<span class='badge rounded-pill bg-primary'>Si</span>";
                }else{
                    
                    return "<a class='badge rounded-pill bg-secondary' data-bs-toggle='collapse' href='#vehiculo_"+row.id+"' role='button' aria-expanded='false' aria-controls='vehiculo_"+row.id+"'><i class='fas fa-eye'></i> No</a>"+
                           "<div class='collapse' id='vehiculo_"+row.id+"'>"+
                           "    <p>"+
                           "        <li>"+row.observacion+"</li>"+
                           "    </p>"+
                           "</div>";
                }
            }
        },{
            "targets": [6],
            "data": "estado",
            "render": function(data,type,row) {
                if (data == 1){
                    return "<span class='badge rounded-pill bg-primary'>Activo</span>";
                }else{
                    return "<span class='badge rounded-pill bg-danger'>Inactivo</span>";
                }
            }
        },{
            "targets": [0],
            "data": "rut",
            "render": function(data,type,row) {
                if(row.idsolicitud == null){
                    return  "<span style='color:#006699'><i class='fas fa-user'></i> &nbsp;"+data+"</span><br>"+
                            "<span style='color:#555'><i class='fas fa-file'></i> &nbsp; Sin Solicitud</span>";
                }else{
                    return  "<span style='color:#006699'><i class='fas fa-user'></i> &nbsp;"+data+"</span><br>"+
                            "<span style='color:#555'><i class='fas fa-file'></i> &nbsp;"+row.idsolicitud+"</span>";
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

</html>