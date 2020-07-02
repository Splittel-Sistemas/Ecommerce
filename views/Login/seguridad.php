<?php 
  @session_start();
    if (!class_exists('SeguridadController')) {
      include $_SERVER['DOCUMENT_ROOT'].'/store/models/Seguridad/Seguridad.Controller.php';
    }

  $SeguridadController = new SeguridadController();
  $SeguridadController->information();