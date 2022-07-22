<!-- Modal - Actualizar Persona -->
<div class="modal fade" id="actualizarPersona" tabindex="-1" aria-labelledby="actualizarPersona" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337ab7;">
        <h5 class="modal-title" id="actualizarPersonaLabel" style="color: #fff;">Actualizar Persona</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 p-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">ID</span>
                </div>
                <input class="form-control" type="text" name="idu" id="idu" disabled>
            </div>
        </div>
        <div class="col-md-12 p-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">RUT</span>
                </div>
                <input class="form-control" type="text" name="rutu" id="rutu" disabled>
            </div>
        </div>
        <div class="col-md-12 p-2">
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
      </div>
        <div class="modal-footer">
            <button class="btn btn-primary" id="botonActualizarPersona">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal - Anular Persona -->
<div class="modal fade" id="eliminarPersona" tabindex="-1" aria-labelledby="eliminarPersona" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #337ab7;">
        <h5 class="modal-title" id="eliminarPersonaLabel" style="color: #fff;">Anular Persona</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input class="form-control" type="text" name="ide" id="ide" hidden>
      <p class="text-center fs-5">Esta opcion cambiara el estado de la persona: <label id="rute"></label></p>

      <p class="text-center fs-5 fw-bold">¿Esta seguro?</p>
      </div>
        <div class="modal-footer">
            <button class="btn btn-danger" id="botonEliminarPersona">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
</div>

</body>