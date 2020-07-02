<?php
  @session_start();
  ini_set('default_socket_timeout', 600);
  if(empty($_SERVER['DOCUMENT_ROOT'])){
    $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
  }if (!class_exists("NumeroGuiaEstatus_Controller")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Paqueteria/PaqueteExpress/NumeroGuiaEstatus_.Controller.php';
  }

  $NumeroGuiaEstatus_Controller = new NumeroGuiaEstatus_Controller();
  $NumeroGuiaEstatus_Controller->GetPedidosEstatusPaqueteriaPaqueteExpress();