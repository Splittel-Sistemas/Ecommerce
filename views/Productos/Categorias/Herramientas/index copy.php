 <div class="row align-items-end pb-4">

    <div class="col-sm-4" id="AnchoSelect">
      <div class="form-group mb-0">
        <label id="AnchoIdText">Longitud (pies)</label>
        <select class="form-control" id="Ancho" name="Ancho" onchange="EquipoIdentificacion()">
            <option value="03">3</option>
            <option value="07">7</option>
            <option value="10">10</option>
            <option value="15">15</option>
        </select>
      </div>
    </div> 

    <div class="col-sm-4" id="ColorSelect">
      <div class="form-group mb-0">
        <label for="quantity">Color</label>
        <select class="form-control" id="Color" name="Color" onchange="EquipoIdentificacion()">
            <option value="AZ">Azul</option>
            <option value="RO">Rojo</option>
            <option value="VE">Verde</option>
            <option value="BL">Blanco</option>
            <option value="GR">Gris</option>
        </select>
      </div>
    </div> 

    <div class="col-sm-4" id="DiametroSelect">
      <div class="form-group mb-0">
        <label id="DiametroIdText">Tipo</label>
        <select class="form-control" id="Diametro" name="Diametro" onchange="EquipoIdentificacion()">
            <option value="0010">1m</option>
            <option value="0020">2m</option>
            <option value="0030">3m</option>
            <option value="0040">4m</option>
            <option value="0050">5m</option>
        </select>
      </div>
    </div> 
   
  </div>