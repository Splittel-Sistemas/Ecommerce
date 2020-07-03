<?php 
  if (!class_exists('CodigoVerificacionController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tokens/CodigoVerificacion.Controller.php';
  }
  
  $CodigoVerificacionController = new CodigoVerificacionController();
  $Result = $CodigoVerificacionController->VerificarCodigo();