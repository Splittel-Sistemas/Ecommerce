<?php
    // C:\xampp3\htdocs/fibra-optica/public/images/img_spl/productos/OPEFEMPANU04001
    
    
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
    header("Access-Control-Allow-Headers: X-Requested-With");
    header("Access-Control-Allow-Origin: X-Requested-With");
    header('Content-Type: text/html; charset=utf-8');
    header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
    class UnZip
    {
        private $TypeFile;
        private $PathZip;
        private $PathExtractTo;
        private $DeleteFileAfter;

        private $ZipModel;

        public function __construct()
        {
            $this->ZipModel = new ZipArchive;
        }
        public function deleteDirectory($dir) {
            if (!file_exists($dir)) {
                return true;
            }
        
            if (!is_dir($dir)) {
                return unlink($dir);
            }
        
            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
        
                if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                    return false;
                }
        
            }
        
            return rmdir($dir);
        }
        public function Unzip(){
            if (file_exists($this->PathZip)) 
            {
                $res = $this->ZipModel->open($this->PathZip);
                if ($res === TRUE) 
                {
                    if (!is_dir($this->PathExtractTo."/360")) 
                    {
                        $this->ZipModel->extractTo($this->PathExtractTo);
                        $this->ZipModel->close();
                        if($this->DeleteFileAfter == true)
                        {
                            unlink($this->PathZip);
                        }
                        echo 'archivos publicados';
                    } 
                    else 
                    {
                        $this->deleteDirectory($this->PathExtractTo."/360");
                        $this->ZipModel->extractTo($this->PathExtractTo);
                        $this->ZipModel->close();
                        if($this->DeleteFileAfter == true)
                        {
                            unlink($this->PathZip);
                        }
                        echo 'archivos publicados2';
                    }
                } 
                else 
                {
                    echo 'Formato no valido!!';
                }
                
            } 
            else 
            {
                throw new Exception("No existe el archivo .zip seleccionado", 1);
            }
        }
        public function Controller()
        {
            try 
            {
                if(!isset($_GET['ItemCode']) && $_GET['ItemCode'] == ''){
                    throw new Exception("El parametro ItemCode esta vacio", 1);
                }
                if(!isset($_GET['Process']) && $_GET['Process'] == ''){
                    throw new Exception("El parametro Process esta vacio", 1);
                }
                if($_GET['Process'] == 'unzip')
                {
                    $this->PathZip = $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/public/images/img_spl/productos/'.$_GET['ItemCode'].'/360.zip';
                    $this->PathExtractTo = $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/public/images/img_spl/productos/'.$_GET['ItemCode'];
                    $this->DeleteFileAfter = true;
                    http_response_code(200);
                    echo $this->Unzip();
                }
                else if($_GET['Process'] == 'delete')
                {
                    $this->PathExtractTo = $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/public/images/img_spl/productos/'.$_GET['ItemCode'].'/360';
                    if (is_dir($this->PathExtractTo)) {
                        $this->deleteDirectory($this->PathExtractTo);
                        http_response_code(200);
                        echo "Folder eliminado";
                    }else{
                        http_response_code(400);
                        echo "El producto no cuenta con vista 360";
                    }
                }
            } 
            catch (\Exception $e) {
                http_response_code(400);
                echo $e->getMessage();
            }
            
        }
    }
    $UnZip = new UnZip();
    $UnZip->Controller();


?>