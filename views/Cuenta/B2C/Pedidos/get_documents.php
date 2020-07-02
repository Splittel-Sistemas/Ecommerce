<?php
@session_start();
  if(isset($_SESSION["Ecommerce-ClienteKey"])){
    if (!class_exists('GetFileInvoiceController')) {
      require_once $_SERVER["DOCUMENT_ROOT"]."/store/models/WebService/Invoice/GetFileInvoice.Controller.php";
    }
    $GetFileInvoiceController = new GetFileInvoiceController();
    $GetFileInvoiceController->TypeFile = $_GET['TypeFile'];
    $GetFileInvoiceController->DocEntry = $_GET['DocEntry'];
    $responseGetFileInvoiceController = $GetFileInvoiceController->get();

    if($responseGetFileInvoiceController->GetFileInvoiceResult->ErrorCode == 0){
        file_put_contents($responseGetFileInvoiceController->GetFileInvoiceResult->FileName, $responseGetFileInvoiceController->GetFileInvoiceResult->File);

        ob_clean(); 
        header("Content-disposition: attachment; filename=".$responseGetFileInvoiceController->GetFileInvoiceResult->FileName);
        header("Content-type: application/$TypeFile");
        readfile($responseGetFileInvoiceController->GetFileInvoiceResult->FileName);
        
        unlink("./".$responseGetFileInvoiceController->GetFileInvoiceResult->FileName);
    }else{
        echo $responseGetFileInvoiceController->GetFileInvoiceResult->ErrorDescription;
    }

  }else{
  echo "No se pudo generar tu solicitud....";
  }
?>