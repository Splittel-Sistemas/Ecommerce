<?php
  @session_start();
  ini_set('default_socket_timeout', 600);
  if(empty($_SERVER['DOCUMENT_ROOT'])){
    $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
  }if (!class_exists("NumeroGuiaEstatusController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Paqueteria/DHL/NumeroGuiaEstatus.Controller.php';
  }

  $NumeroGuiaEstatusController = new NumeroGuiaEstatusController();
  $NumeroGuiaEstatusController->GetPedidosEstatusPaqueteriaDHL();