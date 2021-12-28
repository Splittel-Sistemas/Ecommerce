<?php 

class CatalogModel{
    
  public $Id;
  public $Title;
  public $LinkImg;
  public $LinkCatalog;
  public $DateRegister;
  public $DateUpdate;
  private $Connection;
  private $Tool;

  public function StartParams($connection, $tool){
    $this->Connection = $connection;
    $this->Tool = $tool;
  }

  public function Get($filter = "")
  {
    $SQLStatement = "select * from catalog ". $filter;
    $result = $this->Connection->QueryReturn($SQLStatement);
    $data = [];

    while($row = $result->fetch_object()){
      $catalogModel = new CatalogModel();
      $catalogModel->Id = $row->id;
      $catalogModel->Title  = $row->title;
      $catalogModel->LinkImg = $row->linkImg;
      $catalogModel->LinkCatalog = $row->linkCatalog;
      $catalogModel->DateRegister = $row->dateRegister;
      $catalogModel->DateUpdate = $row->dateUpdate;
      $data[] = $catalogModel;
    }
    return $data;
  }
}