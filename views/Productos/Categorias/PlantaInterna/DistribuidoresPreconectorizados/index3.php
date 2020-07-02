<?php
  if (!class_exists("EstructuraController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Configurables/Estructura.Controller.php';
  }
  $EstructuraController = new EstructuraController();
  $ResultEstructura = $EstructuraController->Estructura();

  $Distribuidores = $ResultEstructura['Distribuidores'];
  $Componentes = $Distribuidores['componentes'];

  $Fabricante = $Componentes['Fabricante'];
  $FabricanteItems = $Fabricante['items'];
  
  $Ensamble = $Componentes['Ensamble'];
  $EnsambleItems = $Ensamble['items'];

  $Familia = $Componentes['Familia'];
  $FamiliaItems = $Familia['items'];

?>

<input type="hidden" name="Fabricante" id="Fabricante" value="<?php echo $FabricanteItems['Abreviatura'] ?>">
<input type="hidden" name="Ensamble" id="Ensamble" value="<?php echo $EnsambleItems['Abreviatura'] ?>">
<input type="hidden" name="Familia" id="Familia" value="<?php echo $FamiliaItems['Abreviatura'] ?>">

<div class="row align-items-end pb-4">
  <div class="col-sm-6" id="TipoFibraSelect">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Acoplador</label>
      <select class="form-control" id="TipoAcoplador" name="TipoAcoplador" onchange="DistribuidoresPreconectorizados()">
        <?php 
          $Acoplador = $Componentes['Acoplador'];
          $AcopladorItems = $Acoplador['items'];
          foreach ($AcopladorItems as $key => $Acoplador_) { 
        ?>
        <option value="<?php echo $Acoplador_['Abreviatura'] ?>" acoplador="<?php echo $Acoplador_['Option_1'] ?>"><?php echo $Acoplador_['Descripcion'] ?></option>
        <?php } ?>
      </select>
    </div>
  </div> 
  <div class="col-sm-6" id="PuertoSelect">
    <div class="form-group mb-0">
      <label for="quantity">Puertos</label>
      <select class="form-control" id="Puertos" name="Puertos" onchange="DistribuidoresPreconectorizados()">
        <?php 
          $Puertos = $Componentes['Puertos'];
          $PuertosItems = $Puertos['items'];
          foreach ($PuertosItems as $key => $Puertos_) { 
        ?>
        <option value="<?php echo $Puertos_['Abreviatura'] ?>"><?php echo $Puertos_['Descripcion'] ?></option>
        <?php } ?>
      </select>
    </div>
  </div>  
  <div class="col-sm-6" id="NumeroAcopladoresSelect">
    <div class="form-group mb-0">
      <label id="NumeroAcopladoresIdText"></label>
      <input type="text" class="form-control" id="NumeroAcopladores" name="NumeroAcopladores" value="1" onkeyup="DistribuidoresPreconectorizados()">
    </div>
  </div>
  <div class="col-sm-6" id="TipoFibraSelect">
    <div class="form-group mb-0">
      <label>Tipo de Fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="DistribuidoresPreconectorizados()" >
      <?php 
          $Fibra = $Componentes['Fibra'];
          $FibraItems = $Fibra['items'];
          foreach ($FibraItems as $key => $Fibra_) { 
        ?>
        <option value="<?php echo $Fibra_['Abreviatura'] ?>"><?php echo $Fibra_['Descripcion'] ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
</div>