<!-- Modal - Actualizar Vehiculo -->
<div class="modal fade" id="actualizarVehiculo" tabindex="-1" aria-labelledby="actualizarVehiculo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337ab7;">
        <h5 class="modal-title" id="actualizarVehiculoLabel" style="color: #fff;">Actualizar Vehiculo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input class="form-control" type="text" name="idu" id="idu" hidden>
      <input class="form-control" type="text" name="idpersonau" id="idpersonau" hidden>
        <div class="col-12 p-2">         
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">TIPO VEHICULO</span>
                </div>
                <select class="form-select" aria-label="Default select example" name="tipou" id="tipou">
                    <option value="empty" selected hidden>Seleccione vehiculo</option>
                    <option value="1" >AutoMovil</option>
                    <option value="2" >Moto</option>
                    <option value="3" >Bicicleta</option>
                </select>
            </div>
        </div>
        <div class="col-12 p-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">MARCA</span>
                </div>
                <input class="form-control" type="text" name="marcau" id="marcau" placeholder="Ingrese marca">
            </div>
        </div>
        <div class="col-md-12 p-2">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">MODELO</span>
            </div>
            <input class="form-control" type="text" name="modelou" id="modelou" placeholder="Ingrese modelo">
            </div>
        </div>
        <div id="show_patenteu" class="col-md-12 p-2">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">PATENTE</span>
            </div>
            <input class="form-control" type="text" name="patenteu" id="patenteu" placeholder="Ingrese patente">
            </div>
        </div>
        <div class="col-12 p-2">         
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">ESTADO</span>
                </div>
                <select class="form-select" aria-label="Default select example" name="estadou" id="estadou">
                    <option value="empty" selected hidden>Seleccione estado</option>
                    <option value="1" >Activo</option>
                    <option value="0" >Inactivo</option>
                </select>
            </div>
        </div>
        <div class="col-12 p-2">         
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
            </div>
        </div>
        <div id="show_observacion" class="col-12 p-2">
          <div class="input-group">
              <span class="input-group-text">OBSERVACION</span>
              <textarea class="form-control" type="text" name="observacion" id="observacion"></textarea>
          </div>
        </div>
      </div>
        <div class="modal-footer">
            <button class="btn btn-primary" id="botonActualizarVehiculo">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal - Eliminar Vehiculo -->
<div class="modal fade" id="eliminarVehiculo" tabindex="-1" aria-labelledby="eliminarVehiculo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337ab7;">
        <h5 class="modal-title" id="eliminarVehiculoLabel" style="color: #fff;">Eliminar Vehiculo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input class="form-control" type="text" name="ide" id="ide" hidden>
      <p class="text-center fs-5">Esta opcion cambiara el estado del vehiculo: <label id="nameVe"></label></p>

      <p class="text-center fs-5 fw-bold">¿Esta seguro?</p>
      </div>
        <div class="modal-footer">
            <button class="btn btn-danger" id="botonEliminarVehiculo">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
</div>

</body>