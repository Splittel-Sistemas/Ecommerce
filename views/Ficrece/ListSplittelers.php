<div class="row">
<?php 
    if (!class_exists('ConsultecnicosController')) {
      include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Consultecnico/Consultecnicos.Controller.php';
    }
    
    $ConsultecnicosController = new ConsultecnicosController();
    $ConsultecnicosController->filter = "WHERE activo='si'";
    $ResultConsultecnicos = $ConsultecnicosController->Get();
    foreach ($ResultConsultecnicos->records as $key => $Object_) {

  ?>

    <div class="col-sm-4 text-center mb-4"><img class="d-block w-150 mx-auto img-thumbnail rounded-circle mb-2" src="../../public/images/img_spl/splittellers/<?php echo $Object_->Imagen; ?>" alt="Team">
        <h6 class="mb-1"><?php echo $Object_->Nombre.' '.$Object_->Apellido; ?></h6>
           <!-- <p class="text-sm text-muted mb-3">Founder, CEO</p>  -->
    </div>
<?php
    }
?>
</div>