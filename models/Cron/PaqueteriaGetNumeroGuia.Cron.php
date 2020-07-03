<?php
  @session_start();
  ini_set('default_socket_timeout', 600);
  if(empty($_SERVER['DOCUMENT_ROOT'])){
    $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
  }if (!class_exists("NumeroGuiaController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Paqueteria/NumeroGuia.Controller.php';
  }

  $NumeroGuiaController = new NumeroGuiaController();
  $NumeroGuiaController->GetNumeroGuiaPaqueteria();