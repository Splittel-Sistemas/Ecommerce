<?php 

  @session_start();
  ini_set('default_socket_timeout', 600);
  if(empty($_SERVER['DOCUMENT_ROOT'])){
    $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
  }if (!class_exists("PedidoB2BTransferenciaController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/Sales/PedidoB2BTransferencia.Controller.php';
  }

  $PedidoB2BTransferenciaController = new PedidoB2BTransferenciaController();
  $PedidoB2BTransferenciaController->create();