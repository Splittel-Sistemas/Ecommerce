<?php
   if (!class_exists('OpenPayController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/OpenPay/OpenPay.Controller.php';
  } 

  $OpenPayController = new OpenPayController();
  $result = $OpenPayController->GetCharge($_GET['id']);
  if($result->status == "completed"){
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Pedido/Completado3DSecure.php'; 
  }else{
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Pedido/Incompleto.php'; 
  }
