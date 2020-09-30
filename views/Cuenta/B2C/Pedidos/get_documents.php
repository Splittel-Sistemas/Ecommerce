<?php
@session_start();
  if(isset($_SESSION["Ecommerce-ClienteKey"])){
    if (!class_exists('GetFileInvoiceController')) {
      require_once $_SERVER["DOCUMENT_ROOT"]."/fibra-optica/models/WebService/Invoice/GetFileInvoice.Controller.php";
    }
    $GetFileInvoiceController = new GetFileInvoiceController();
    $GetFileInvoiceController->TypeFile = $_GET['TypeFile'];
    $GetFileInvoiceController->DocEntry = $_GET['DocEntry'];
    $responseGetFileInvoiceController = $GetFileInvoiceController->get();

    if($responseGetFileInvoiceController->GetFileInvoiceResult->ErrorCode == 0){
        if (file_exists("./".$responseGetFileInvoiceController->GetFileInvoiceResult->FileName)) {
          
        }
        else
        {
          $file = fopen("./".$responseGetFileInvoiceController->GetFileInvoiceResult->FileName, "w"); 
          fwrite($file, $responseGetFileInvoiceController->GetFileInvoiceResult->File);
          fclose($file);
        }

        header('Content-Description: File Transfer');
        header("Content-Type: application/force-download");
        header('Content-Disposition: attachment; filename="'.$responseGetFileInvoiceController->GetFileInvoiceResult->FileName.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize("./".$responseGetFileInvoiceController->GetFileInvoiceResult->FileName));
        readfile("./".$responseGetFileInvoiceController->GetFileInvoiceResult->FileName);
        
        unlink("./".$responseGetFileInvoiceController->GetFileInvoiceResult->FileName);

    }else{
        echo $responseGetFileInvoiceController->GetFileInvoiceResult->ErrorDescription;
    }

  }else{
  echo "No se pudo generar tu solicitud....";
  }
?>