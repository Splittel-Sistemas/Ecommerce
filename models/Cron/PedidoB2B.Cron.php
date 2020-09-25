<?php 

  @session_start();
  ini_set('default_socket_timeout', 600);
  if(empty($_SERVER['DOCUMENT_ROOT'])){
    $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
  }if (!class_exists("PedidoB2BController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/Sales/PedidoB2B.Controller.php';
  }

  $PedidoB2BController = new PedidoB2BController();
  $PedidoB2BController->create();