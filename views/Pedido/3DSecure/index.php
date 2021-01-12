<?php 
  if (!class_exists('WebhookController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Logs/Webhook.Controller.php';
  }

  $WebhookController = new WebhookController();
  $WebhookController->filter = "WHERE t12_f002 = '".$_GET["Key"]."' AND t12_f004 = 'completed' ";
  $WebhookController->order = "";
  $ExistWebhook = $WebhookController->GetBy();
  if($ExistWebhook){
    header('Location: ../Completado');
  }
  header('Location: ../Incompleto');