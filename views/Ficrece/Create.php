<div class="row no-gutters">
  <div class="col-md-12" id="notify" data-offset-top="-1">
    <div class=" py-5 px-3 justify-content-center align-items-center">
      <form class="row">
        <div class="col-sm-12 col-md-12 form-group">
          <label>Nombre <strong class="text-danger">*</strong></label>
          <input class="form-control" type="text" id="Nombre" name="Nombre">
        </div>
        <div class="col-sm-12 col-md-12 form-group">
          <label>Direccion de Correo electronico<strong class="text-danger">*</strong></label>
          <input class="form-control" type="email" id="Correo" name="Correo">
        </div>
        <div class="col-sm-12 col-md-12 form-group">
          <label>Monto de linea de credito solicitada<strong class="text-danger">*</strong></label>
          <input class="form-control" type="number" id="Monto" name="Monto">
          <small>indica la cantidad en dolares americanos</small>
        </div>  
        <div class="col-sm-12 col-md-12 form-group">
        
        <label>Fecha de solicitud <strong class="text-danger">*</strong></label>
   
          <input class="form-control" type="date" id="date" name="date">
        </div>
        <div class="col-sm-12">
          <button type="button" class="btn btn-primary float-right" onclick="EnviarSolicitud()">Enviar Pregunta</button>
        </div>
      </form>
    </div>
  </div>
</div>