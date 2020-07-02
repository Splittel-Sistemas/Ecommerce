<?php 

  @session_start();
  ini_set('default_socket_timeout', 600);
  if(empty($_SERVER['DOCUMENT_ROOT'])){
    $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
  }if (!class_exists("PedidoB2CController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/Invoice/PedidoB2C.Controller.php';
  }

  $PedidoB2CController = new PedidoB2CController();
  $PedidoB2CController->create();