<!-- Modal agregar solicitud -->
<!-- Modal -->
<div class="modal fade " id="modalS" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalSLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <h5 class="modal-title" id="modalSLabel" style="color: #fff;">Añadir Solicitud</h5>
            </div>
            <div class="modal-body">
                <div id="liveAlertPlaceholder4"></div>
                <input class="form-control" type="text" name="idpersonaS" id="idpersonaS" hidden>
                <div id="container">
                    <div class="row p-4">
                        <div class="col-md-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">RUT</div>
                                </div>
                                <input class="form-control" type="text" name="rutS" id="rutS" placeholder="Ingrese rut - (12345678)" maxlength="8" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" min="1" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" name="botonBuscarRutS"><i class="fas fa-search"></i></button>
                                </div>

                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">NOMBRE</span>
                                </div>
                                <input class="form-control" type="text" name="nombresS" id="nombresS" placeholder="Nombre completo" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container">
                    <div class="row p-4">
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">TIPO</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="tipoS" id="tipoS" required>


                                    <option value="" selected="selected" hidden>Seleccione tipo de solicitud</option>
                                    <option value="1">AutoMovil</option>
                                    <option value="2">Moto</option>
                                    <option value="3">Bicicleta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CALIDAD JURIDICA</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="cal_jur" id="cal_jur">
                                    <option value="" selected="selected" hidden>Seleccione calidad juridica</option>
                                    <option value="0">Titular</option>
                                    <option value="1">Contrata</option>
                                    <option value="2">Honorario</option>
                                    <option value="3">Prestaciones</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">SERVICIO / UNIDAD</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="ser_uni" id="ser_uni" required>
                                    <option value="" selected="selected" hidden>Seleccione servicio/unidad</option>
                                    <?php
                                    foreach ($servicios as $d) {
                                        $ccosto_aba     = $d->ccosto_aba;
                                        $descrip        = $d->descripcion_cc;
                                        echo '<option value="' . $ccosto_aba . '">' . $descrip . '</option>
                                    ';
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">JORNADA LABORAL</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="jor_lab" id="jor_lab" required>
                                    <option value="" selected="selected" hidden>Seleccione jordana laboral</option>
                                    <option value="0">44 hrs</option>
                                    <option value="1">22 hrs</option>
                                    <option value="2">33 hrs</option>
                                    <option value="3">11 hrs</option>
                                    <option value="4">22 - 28 hrs</option>
                                    <option value="5">turno 3</option>
                                    <option value="6">turno 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 p-2">
                            <div class="row justify-content-center">
                                <!--
                        <div class="col-1 p-2"></div>
                        <div class="col-4 p-2" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                            <div class="row  justify-content-center">
                                <p class="text-center fs-5"><i class="fas fa-calendar-alt"></i> Dias de Semana</p>
                            </div>
                        </div>
                        <div class="col-2 p-2"></div>    
                        <div class="col-4 p-2" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                            <div class="row  justify-content-center">
                                <p class="text-center fs-5"><i class="fas fa-calendar-alt"></i> Horario Jornada Laboral</p>
                            </div>
                        </div>
                        <div class="col-1 p-2"></div>
                        -->
                                <div class="col-6 p-2" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                    <div class="row justify-content-center">
                                        <p class="text-center fs-5"><i class="fas fa-calendar-alt"></i> Dias de Semana</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 p-2" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group" style="width: 100%;">
                                        <input type="checkbox" class="btn-check" id="dia1" value="1" name="diasSemana" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="dia1">Lun</label>

                                        <input type="checkbox" class="btn-check" id="dia2" value="2" name="diasSemana" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="dia2">Mar</label>

                                        <input type="checkbox" class="btn-check" id="dia3" value="3" name="diasSemana" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="dia3">Mie</label>

                                        <input type="checkbox" class="btn-check" id="dia4" value="4" name="diasSemana" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="dia4">Jue</label>

                                        <input type="checkbox" class="btn-check" id="dia5" value="5" name="diasSemana" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="dia5">Vie</label>

                                        <input type="checkbox" class="btn-check" id="dia6" value="6" name="diasSemana" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="dia6">Sab</label>

                                        <input type="checkbox" class="btn-check" id="dia7" value="7" name="diasSemana" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="dia7">Dom</label>
                                    </div>
                                </div>
                                <!--
                        <div class="col-1 p-2"></div>
                        <div class="col-4 p-2" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                            <div class="row  justify-content-center">
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">L</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">M</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">M</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">J</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">V</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">S</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">D</span>
                                </div>
                            </div>
                            <div class="row  justify-content-center">
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="1" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="2" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="3" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="4" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="5" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="6" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="7" name="diasSemana">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 p-2"></div>
                        <div class="col-4 p-2" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                            <div class="row  justify-content-center">
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">L</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">M</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">M</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">J</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">V</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">S</span>
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                <span class="text-center fw-bold">D</span>
                                </div>
                            </div>
                            <div class="row  justify-content-center">
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="8" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="9" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="10" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="11" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="12" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="13" name="diasSemana">
                                </div>
                                <div class="col-1" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                <input class="form-check-input" type="checkbox" value="14" name="diasSemana">
                                </div>
                            </div>
                        </div>
                        -->
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container">
                    <div class="row p-4">
                        <div id="liveAlertPlaceholder6"></div>
                        <div class="col-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">MARCA</span>
                                </div>
                                <input class="form-control" type="text" name="marca2" id="marca2" placeholder="Ingrese marca">
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">MODELO</span>
                                </div>
                                <input class="form-control" type="text" name="modelo2" id="modelo2" placeholder="Ingrese modelo">
                            </div>
                        </div>
                        <div id="show_patenteS" class="col-md-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PATENTE</span>
                                </div>
                                <input class="form-control" type="text" name="patente2" id="patente2" placeholder="Ingrese patente">
                            </div>
                        </div>
                        <div class="col-md-10 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PROPIETARIO</span>
                                </div>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" value="1" name="btnradio" id="Si" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="Si">Si</label>

                                    <input type="radio" class="btn-check" value="0" name="btnradio" id="No" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="No">No</label>
                                </div>
                                <input class="form-control" type="text" name="ObservacionAuto" id="ObservacionAuto" placeholder="Ingrese observacion del vehiculo" style="display: none;">
                            </div>
                        </div>
                        <div class="col-md-2 p-2">
                            <button class="btn btn-primary" id="botonAñadirVehiculo2">Añadir Vehiculo</button>
                        </div>
                    </div>
                    <div id="refresh" class="col-12 p-2">
                        <table id="miTabla2" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>PATENTE</th>
                                    <th>PROPIETARIO</th>
                                    <th>OBSERVACION</th>
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnCerrarS" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="añadirSolicitudX">Añadir Solicitud</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal - Añadir Vehiculo -->
<div class="modal fade" id="añadirVehiculo" tabindex="-1" aria-labelledby="añadirVehiculo" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <h5 class="modal-title" id="añadirVehiculoLabel" style="color: #fff">Añadir <label id="nameTipo"></label></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="text" name="idpersona" id="idpersona" hidden>
                <input class="form-control" type="text" name="idsolicitud" id="idsolicitud" hidden>
                <input class="form-control" type="text" name="tipo" id="tipo" hidden>
                <div class="row p-2">
                    <div id="liveAlertPlaceholder3"></div>
                    <div class="col-md-4 p-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">MARCA</span>
                            </div>
                            <input class="form-control" type="text" name="marca" id="marca" placeholder="Ingrese marca">
                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">MODELO</span>
                            </div>
                            <input class="form-control" type="text" name="modelo" id="modelo" placeholder="Ingrese modelo">
                        </div>
                    </div>
                    <div id="show_patente" class="col-md-4 p-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">PATENTE</span>
                            </div>
                            <input class="form-control" type="text" name="patente" id="patente" placeholder="Ingrese patente">
                        </div>
                    </div>
                    <div class="col-md-10 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PROPIETARIO</span>
                                </div>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" value="1" name="btnradioVeh" id="SiVeh" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="SiVeh">Si</label>

                                    <input type="radio" class="btn-check" value="0" name="btnradioVeh" id="NoVeh" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="NoVeh">No</label>
                                </div>
                                <input class="form-control" type="text" name="ObservacionAutoVeh" id="ObservacionAutoVeh" placeholder="Ingrese observacion del vehiculo" style="display: none;">
                            </div>
                        </div>
                    <div id="show_patente" class="col-md-2 p-2">
                        <button class="btn btn-primary" id="botonAñadirVehiculo">Añadir Vehiculo</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="refresh" class="col-12 p-2">
                    <table id="miTabla" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>RUT</th>
                                <th>MARCA</th>
                                <th>MODELO</th>
                                <th>PATENTE</th>
                                <th>PROPIETARIO</th>
                                <th>OBSERVACION</th>
                                <th>COMANDO</th>
                            </tr>

                        </thead>
                        <tbody id="contenido">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal - Anular Vehiculo -->
<div class="modal fade" id="anularVehiculo" tabindex="-1" aria-labelledby="anularVehiculo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <h5 class="modal-title" id="anularVehiculoLabel" style="color: #fff;">Anular Vehiculo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="text" name="idVa" id="idVa" hidden>
                <input class="form-control" type="text" name="idsolicitudVa" id="idsolicitudVa" hidden>
                <input class="form-control" type="text" name="tipoVa" id="tipoVa" hidden>
                <p class="text-center fs-5">Esta opcion cambiara el estado del vehiculo: <label id="nameVa"></label></p>

                <p class="text-center fs-5 fw-bold">¿Esta seguro?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="botonAnularVehiculo">Confirmar</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal - Actualizar Solicitud -->
<div class="modal fade" id="actualizarSolicitud" tabindex="-1" aria-labelledby="actualizarSolicitud" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <h5 class="modal-title" id="actualizarSolicitudLabel" style="color: #fff;">Actualizar Solicitud</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="text" name="idSu" id="idSu" hidden>
                <input class="form-control" type="text" name="idpersonaSu" id="idpersonaSu" hidden>
                <input class="form-control" type="text" name="tipoWard" id="tipoWard" hidden>
                <div id="container">
                    <div class="row p-4">
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">TIPO</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="tipoSu" id="tipoSu">
                                    <option value="empty" selected hidden>Seleccione tipo de solicitud</option>
                                    <option value="1">AutoMovil</option>
                                    <option value="2">Moto</option>
                                    <option value="3">Bicicleta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ESTADO</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="estadoSu" id="estadoSu">
                                    <option value="empty" selected hidden>Seleccione estado</option>
                                    <option value="0">Pendiente</option>
                                    <? if ($permiso > 1) { ?>
                                        <option value="1">Autorizada</option>
                                        <option value="2">Rechazada</option>
                                    <? } ?>
                                    <option value="9">Anulada</option>
                                </select>
                            </div>
                        </div>
                        <? if ($permiso == 2) { ?>
                            <div id="show_tar" class="col-12 p-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text d-block"><i class="fas fa-address-card"></i></span>
                                    </div>
                                    <input class="form-control" type="text" name="tarjeta" id="tarjeta" placeholder="Ingrese numero de la tarjeta" maxlength="11" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" min="1">
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
                <div id="container">
                    <div class="row p-4">
                        <div class="col-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">FECHA SOLICITUD</span>
                                </div>
                                <input class="form-control" type="date" name="fechasolicitudSu" id="fechasolicitudSu" disabled>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">FECHA AUTORIZACION</span>
                                </div>
                                <input class="form-control" type="date" name="fechaautorizacionSu" id="fechaautorizacionSu" disabled>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">FECHA ANULACION</span>
                                </div>
                                <input class="form-control" type="date" name="fechaanulacionSu" id="fechaanulacionSu" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container">
                    <div class="row p-4">
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">SERVICIO / UNIDAD</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="ser_uniSu" id="ser_uniSu">
                                    <option value="empty" selected hidden>Seleccione servicio/unidad</option>
                                    <?php
                                    foreach ($servicios as $d) {
                                        $ccosto_aba         = $d->ccosto_aba;
                                        $descrip            = $d->descripcion_cc;
                                        echo '<option value="' . $ccosto_aba . '">' . $descrip . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CALIDAD JURIDICA</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="cal_jurSu" id="cal_jurSu">
                                    <option value="empty" selected hidden>Seleccione calidad juridica</option>
                                    <option value="0">Titular</option>
                                    <option value="1">Contrata</option>
                                    <option value="2">Honorario</option>
                                    <option value="3">Prestaciones</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">JORNADA LABORAL</span>
                                </div>
                                <select class="form-select" aria-label="Default select example" name="jor_labSu" id="jor_labSu">
                                    <option value="empty" selected hidden>Seleccione jordana laboral</option>
                                    <option value="0">44 hrs</option>
                                    <option value="1">22 hrs</option>
                                    <option value="2">33 hrs</option>
                                    <option value="3">11 hrs</option>
                                    <option value="4">22 - 28 hrs</option>
                                    <option value="5">turno 3</option>
                                    <option value="6">turno 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">N° LISTA ESPERA</span>
                                </div>
                                <input class="form-control" type="text" name="correlativolistaesperaSu" id="correlativolistaesperaSu" disabled>
                            </div>
                        </div>
                        <div class="col-12 p-2">
                            <div class="row justify-content-center">
                                <div class="col-6 p-2" style="border: 1px solid #ced4da;background-color: #e9ecef;border-radius: 0.25rem;">
                                    <div class="row  justify-content-center">
                                        <p class="text-center fs-5"><i class="fas fa-calendar-alt"></i> Dias de Semana</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 p-2" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group" style="width: 100%;">
                                        <input type="checkbox" class="btn-check" id="diasSemanaSu1" value="1" name="diasSemanaSu" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="diasSemanaSu1">Lun</label>

                                        <input type="checkbox" class="btn-check" id="diasSemanaSu2" value="2" name="diasSemanaSu" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="diasSemanaSu2">Mar</label>

                                        <input type="checkbox" class="btn-check" id="diasSemanaSu3" value="3" name="diasSemanaSu" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="diasSemanaSu3">Mie</label>

                                        <input type="checkbox" class="btn-check" id="diasSemanaSu4" value="4" name="diasSemanaSu" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="diasSemanaSu4">Jue</label>

                                        <input type="checkbox" class="btn-check" id="diasSemanaSu5" value="5" name="diasSemanaSu" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="diasSemanaSu5">Vie</label>

                                        <input type="checkbox" class="btn-check" id="diasSemanaSu6" value="6" name="diasSemanaSu" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="diasSemanaSu6">Sab</label>

                                        <input type="checkbox" class="btn-check" id="diasSemanaSu7" value="7" name="diasSemanaSu" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="diasSemanaSu7">Dom</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container">
                    <div class="row p-4">
                        <div class="col-12 p-2">
                            <div class="input-group">
                                <span class="input-group-text">OBSERVACIONES</span>
                                <textarea class="form-control" type="text" name="observacionesSu" id="observacionesSu"></textarea>
                            </div>
                        </div>
                        <div id="show_motivo2" class="col-12 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">FECHA RECHAZO</span>
                                </div>
                                <input class="form-control" type="date" name="fecharechazoSu" id="fecharechazoSu" disabled>
                            </div>
                        </div>
                        <div id="show_motivo" class="col-12 p-2">
                            <div class="input-group">
                                <span class="input-group-text">MOTIVO</span>
                                <textarea class="form-control" type="text" name="motivorechazoSu" id="motivorechazoSu"></textarea>
                            </div>
                        </div>
                        <div id="show_obau" class="col-12 p-2">
                            <div class="input-group">
                                <span class="input-group-text">OBSERVACION AUTORIZACION</span>
                                <textarea class="form-control" type="text" name="observacionautorizaSu" id="observacionautorizaSu"></textarea>
                            </div>
                        </div>
                        <div id="show_oban" class="col-12 p-2">
                            <div class="input-group">
                                <span class="input-group-text">OBSERVACION ANULACION</span>
                                <textarea class="form-control" type="text" name="observacionanulaSu" id="observacionanulaSu"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container">
                    <div class="row p-4">
                        <div id="liveAlertPlaceholder5"></div>
                        <div class="col-md-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">MARCA</span>
                                </div>
                                <input class="form-control" type="text" name="marcaSu" id="marcaSu" placeholder="Ingrese marca">
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">MODELO</span>
                                </div>
                                <input class="form-control" type="text" name="modeloSu" id="modeloSu" placeholder="Ingrese modelo">
                            </div>
                        </div>
                        <div id="show_patente" class="col-md-4 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PATENTE</span>
                                </div>
                                <input class="form-control" type="text" name="patenteSu" id="patenteSu" placeholder="Ingrese patente">
                            </div>
                        </div>
                        <div class="col-md-10 p-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PROPIETARIO</span>
                                </div>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradioSu" id="SiSu" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="SiSu">Si</label>

                                    <input type="radio" class="btn-check" name="btnradioSu" id="NoSu" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="NoSu">No</label>
                                </div>
                                <input class="form-control" type="text" name="ObservacionAutoSu" id="ObservacionAutoSu" placeholder="Ingrese observacion del vehiculo" style="display: none;">
                            </div>
                        </div>
                        <div class="col-md-2 p-2">
                            <button class="btn btn-primary" id="botonAñadirVehiculoSu">Añadir Vehiculo</button>
                        </div>
                    </div>
                    <div id="refresh" class="col-12 p-2">
                        <table id="miTabla3" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>RUT</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>PATENTE</th>
                                    <th>PROPIETARIO</th>
                                    <th>OBSERVACION</th>
                                    <th>COMANDO</th>
                                </tr>

                            </thead>
                            <tbody id="contenido3">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="botonActualizarSolicitud">Actualizar</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal - Anular Solicitud -->
<div class="modal fade" id="anularSolicitud" tabindex="-1" aria-labelledby="anularSolicitud" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <h5 class="modal-title" id="anularSolicitudLabel" style="color: #fff;">Anular Solicitud</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="text" name="idSe" id="idSe" hidden>
                <input class="form-control" type="text" name="tipoSe" id="tipoSe" hidden>
                <input class="form-control" type="text" name="estadoSe" id="estadoSe" hidden>
                <input class="form-control" type="text" name="correlativolistaesperaSe" id="correlativolistaesperaSe" hidden>
                <p class="text-center fs-5">Esta opcion cambiara el estado de la solicitud: <label id="nameSe"></label></p>

                <p class="text-center fs-5 fw-bold">¿Esta seguro?</p>
            </div>
            <div class="col-12 p-2">
                <div class="input-group">
                    <span class="input-group-text">OBSERVACIONES</span>
                    <textarea class="form-control" type="text" name="observacionesSe" id="observacionesSe"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" id="botonAnularSolicitud">Confirmar</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal - Autorizar Solicitud -->
<div class="modal fade" id="autorizarSolicitud" tabindex="-1" aria-labelledby="autorizarSolicitud" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <h5 class="modal-title" id="autorizarSolicitudLabel" style="color: #fff;">Autorizar Solicitud</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="text" name="idSa" id="idSa" hidden>
                <input class="form-control" type="text" name="tipoSa" id="tipoSa" hidden>
                <input class="form-control" type="text" name="correlativolistaesperaSa" id="correlativolistaesperaSa" hidden>
                <div id="liveAlertPlaceholder7"></div>
                <p class="text-center fs-5">Esta opcion cambiara el estado de la solicitud: <label id="nameSa"></label></p>

                <p class="text-center fs-5 fw-bold">¿Esta seguro?</p>
            </div>
            <div class="col-12 p-2">
                <div class="input-group">
                    <span class="input-group-text">OBSERVACIONES</span>
                    <textarea class="form-control" type="text" name="observacionesSa" id="observacionesSa"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="botonAutorizarSolicitud">Confirmar</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal - Rechazar Solicitud -->
<div class="modal fade" id="rechazarSolicitud" tabindex="-1" aria-labelledby="rechazarSolicitud" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <h5 class="modal-title" id="rechazarSolicitudLabel" style="color: #fff;">Rechazar Solicitud</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="text" name="idSr" id="idSr" hidden>
                <input class="form-control" type="text" name="tipoSr" id="tipoSr" hidden>
                <input class="form-control" type="text" name="correlativolistaesperaSr" id="correlativolistaesperaSr" hidden>
                <p class="text-center fs-5">Esta opcion cambiara el estado de la solicitud: <label id="nameSr"></label></p>

                <p class="text-center fs-5 fw-bold">¿Esta seguro?</p>
            </div>
            <div class="col-12 p-2">
                <div class="input-group">
                    <span class="input-group-text">MOTIVO</span>
                    <textarea class="form-control" type="text" name="motivorechazoSr" id="motivorechazoSr"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="botonRechazarSolicitud">Confirmar</button>
            </div>
        </div>
    </div>
</div>
</div>

</body>

</html>