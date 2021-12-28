<?php

  @session_start();
  if (!class_exists("Connection")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists("CatalogModel")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/catalog/Catalog.Model.php';
  }

  class CatalogController{

    private $Connection;
    private $Tool;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Get(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $catalogModel = new CatalogModel();
          $catalogModel->StartParams($this->Connection, $this->Tool);
          $result = $catalogModel->Get();
          return $result;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
  }