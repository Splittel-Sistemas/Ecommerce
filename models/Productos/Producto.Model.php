<?php
  class Producto{
    public $ProductoKey;
    public $Codigo;
    public $Descripcion;
    public $DescripcionLarga;
    public $DescripcionCeo;
    public $Img;
    public $CategoriaCodigo;
    public $SubcategoriaCodigo;
    public $MarcaKey;
    public $Valoraciones;
    public $Precio;
    public $Descuento;
    public $Existencia;
    public $Caracteristicas;
    public $InformacionTecnica;
    public $Novedades;
    public $HojaTecnica;
    public $PesosDimensiones;
    public $InformacionAdicional;
    public $Relacionados;
    public $CodigoConfigurable;
    public $Activo;
    public $Manejado;
    public $ImgPrincipal;
    public $Destacado;
    public $Leyenda;
    public $MinimoCompra;
    public $PrecioMXN;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }
    public function SetProductoKey($ProductoKey){
      if(!is_numeric($ProductoKey)){
        throw new Exception('$ProductoKey debería de ser int');
      }
      $this->ProductoKey = $ProductoKey;
    }
    public function SetCodigo($Codigo){
      if(!is_string($Codigo)){
        throw new Exception('$Codigo debería de ser int');
      }
      $this->Codigo = $Codigo;
    }
    public function SetDescripcion($Descripcion){
      if(!is_string($Descripcion)){
        throw new Exception('$Descripcion debería de ser int');
      }
      $this->Descripcion = $Descripcion;
    }
    public function SetDescripcionLarga($DescripcionLarga){
      if(!is_string($DescripcionLarga)){
        throw new Exception('$DescripcionLarga debería de ser int');
      }
      $this->DescripcionLarga = $DescripcionLarga;
    }
    public function SetImg($Img){
      if(!is_string($Img)){
        throw new Exception('$Img debería de ser int');
      }
      $this->Img = $Img;
    }

    public function GetCodigo(){
     return $this->Codigo;
    }
    
    public function GetPrecio(){
     return $this->Precio;
    }

    public function GetBy($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM catalogo_productos ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->ProductoKey              =   $row->id;
          $this->Codigo                   =   $row->codigo;
          $this->Descripcion              =   $row->desc_producto;
          $this->DescripcionLarga         =   $row->id_desc_larga;
          $this->Img                      =   $row->id_imagen;
          $this->CategoriaCodigo          =   $row->categoria;
          $this->SubcategoriaCodigo       =   $row->subcategoria;
          $this->MarcaKey                 =   $row->id_marca;
          $this->Valoraciones             =   $row->valoraciones;
          $this->Precio                   =   $row->precio;
          $remates = $this->CategoriaCodigo == "A8" ? true : false;
          $this->Descuento                =   $this->Tool->CalcularDescuento($row->descuento_producto);
          $this->Existencia               =   $row->existencia;
          $this->Caracteristicas          =   $row->caracteristicas;
          $this->InformacionTecnica       =   $row->info_tecnica;
          $this->Novedades                =   $row->novedades;
          $this->HojaTecnica              =   $row->hoja_tecnica;
          $this->PesosDimensiones         =   $row->pesos_dimensiones;
          $this->InformacionAdicional     =   $row->info_adicional;
          $this->Relacionados             =   $row->productos_relacionados;
          $this->CodigoConfigurable       =   $row->codigo_configurable;
          $this->Activo                   =   $row->activo;
          $this->Manejado                 =   $row->manejado_por;
          $this->ImgPrincipal             =   $row->img_principal;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    
        

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM catalogo_productos ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Producto = new Producto();
          $Producto->ProductoKey              =   $row->id;
          $Producto->Codigo                   =   $row->codigo;
          $Producto->Descripcion              =   $row->desc_producto;
          $Producto->DescripcionLarga         =   $row->id_desc_larga;
          $Producto->Img                      =   $row->id_imagen;
          $Producto->CategoriaCodigo          =   $row->categoria;
          $Producto->SubcategoriaCodigo       =   $row->subcategoria;
          $Producto->MarcaKey                 =   $row->id_marca;
          $Producto->Valoraciones             =   $row->valoraciones;
          $Producto->Precio                   =   $row->precio;
          $remates = $Producto->CategoriaCodigo == "A8" ? true : false;
          $Producto->Descuento                =   $this->Tool->CalcularDescuento($row->descuento_producto);
          $Producto->Existencia               =   $row->existencia;
          $Producto->Caracteristicas          =   $row->caracteristicas;
          $Producto->InformacionTecnica       =   $row->info_tecnica;
          $Producto->Novedades                =   $row->novedades;
          $Producto->HojaTecnica              =   $row->hoja_tecnica;
          $Producto->PesosDimensiones         =   $row->pesos_dimensiones;
          $Producto->InformacionAdicional     =   $row->info_adicional;
          $Producto->Relacionados             =   $row->productos_relacionados;
          $Producto->CodigoConfigurable       =   $row->codigo_configurable;
          $Producto->Activo                   =   $row->activo;
          $Producto->Manejado                 =   $row->manejado_por;
          $Producto->ImgPrincipal             =   $row->img_principal;
          $data[] = $Producto;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListProductosFijos($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_productos_fijos ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        if ($result) { 
        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->ProductoKey                       =   $row->id;
          $Obj->ProductoCodigo                    =   $row->codigo;
          $Obj->ProductoCodigoWhitOutSlash        =   str_replace("/", "-",$row->codigo);
          $Obj->ProductoDescripcion               =   $row->desc_producto;
          $Obj->ProductoDescripcionLargaKey       =   $row->producto_id_desc_larga;
          $Obj->ProductoCategoriaKey              =   $row->categoria;
          $Obj->ProductoSubcategoriaKey           =   $row->subcategoria;
          $Obj->ProductoMarcaKey                  =   $row->producto_id_marca;
          $Obj->ProductoPrecio                    =   $row->precio;
          $Obj->ProductoDescuento                 =   $row->descuento_producto;
          $remates = $Obj->ProductoCategoriaKey == "A8" ? true : false;
          $Obj->Descuento                         =   $this->Tool->CalcularDescuento($row->descuento_producto);
          $Obj->ProductoExistencia                =   $row->existencia;
          $Obj->ProductoInformacionTecnica        =   $row->info_tecnica;
          $Obj->ProductoPesosDimensiones          =   $row->pesos_dimensiones;
          $Obj->ProductoInformacionAdicional      =   $row->info_adicional;
          $Obj->ProductoRelacionados              =   $row->productos_relacionados;
          $Obj->ProductoCodigoConfigurable        =   $row->codigo_configurable;
          $Obj->ProductoActivo                    =   $row->producto_activo;
          $Obj->ProductoManejado                  =   $row->manejado_por;
          $Obj->ProductoImgPrincipal              =   $row->img_principal;
          $Obj->DescripcionLarga                  =   $row->desc_larga;
          $Obj->DescripcionCeo                    =   $row->desc_ceo;
          $Obj->CategoriaFamiliaDescripcion       =   $row->desc_familia;
          $Obj->CategoriaActivo                   =   $row->categoria_activo;
          $Obj->CategoriaMenu1                    =   $row->menu1;
          $Obj->CategoriaMenu2                    =   $row->menu2;
          $Obj->CategoriaFolderName               =   $row->folder_name;
          $Obj->CategoriaDescripcion              =   $row->categoria_descripcion;
          $Obj->SubcategoriaDescripcion           =   $row->desc_subcategoria;
          $Obj->SubcategoriaSubnivel              =   $row->subnivel;
          $Obj->SubcategoriaActivo                =   $row->subcategoria_activo;
          $Obj->SubcategoriaDescripcionAdicional  =   $row->subcategoria_descripcion;
          $Obj->MarcaDesripcion                   =   $row->desc_marca;
          $Obj->FichaKey                          =   $row->ficha_id;
          $Obj->FichaRuta                         =   $row->ruta;
          $Obj->Destacado                         =   $row->destacado;
          $Obj->Certificado                       =   $this->ExistCert($row->codigo);
          $Obj->ConfigurableFijo                  =   $row->configurablefijo;
          $Obj->Leyenda                  =   $row->leyenda;
          $Obj->MinimoCompra                      =   $row->cantidad_minima;
          $Obj->PrecioMXN                         =   $row->precio_mxn;
          $data[] = $Obj;
        }
      }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListProductosMasVendidos($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT *, COUNT(*) AS total FROM listar_productos_mas_vendidos_ ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->ProductoKey                       =   $row->ProductoKey;
          $Obj->ProductoCodigo                    =   $row->codigo;
          $Obj->ProductoDescripcion               =   $row->desc_producto;
          $Obj->ProductoDescripcionLargaKey       =   $row->producto_id_desc_larga;
          $Obj->ProductoCategoriaKey              =   $row->categoria;
          $Obj->ProductoSubcategoriaKey           =   $row->subcategoria;
          $Obj->ProductoMarcaKey                  =   $row->producto_id_marca;
          $Obj->ProductoPrecio                    =   $row->precio;
          $Obj->ProductoDescuento                 =   $row->descuento_producto;
          $remates = $Obj->ProductoCategoriaKey == "A8" ? true : false;
          $Obj->Descuento                         =   $this->Tool->CalcularDescuento($row->descuento_producto);
          $Obj->ProductoExistencia                =   $row->existencia;
          $Obj->ProductoInformacionTecnica        =   $row->info_tecnica;
          $Obj->ProductoPesosDimensiones          =   $row->pesos_dimensiones;
          $Obj->ProductoInformacionAdicional      =   $row->info_adicional;
          $Obj->ProductoRelacionados              =   $row->productos_relacionados;
          $Obj->ProductoCodigoConfigurable        =   $row->codigo_configurable;
          $Obj->ProductoActivo                    =   $row->producto_activo;
          $Obj->ProductoManejado                  =   $row->manejado_por;
          $Obj->ProductoImgPrincipal              =   $row->img_principal;
          $Obj->DescripcionLarga                  =   $row->desc_larga;
          $Obj->CategoriaFamiliaDescripcion       =   $row->desc_familia;
          $Obj->CategoriaActivo                   =   $row->categoria_activo;
          $Obj->CategoriaMenu1                    =   $row->menu1;
          $Obj->CategoriaMenu2                    =   $row->menu2;
          $Obj->CategoriaFolderName               =   $row->folder_name;
          $Obj->CategoriaDescripcion              =   $row->categoria_descripcion;
          $Obj->SubcategoriaDescripcion           =   $row->desc_subcategoria;
          $Obj->SubcategoriaSubnivel              =   $row->subnivel;
          $Obj->SubcategoriaActivo                =   $row->subcategoria_activo;
          $Obj->SubcategoriaDescripcionAdicional  =   $row->subcategoria_descripcion;
          $Obj->MarcaDesripcion                   =   $row->desc_marca;
          $Obj->FichaKey                          =   $row->ficha_id;
          $Obj->FichaRuta                         =   $row->ruta;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListProductosMejorValorados($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT *, 
          COUNT(*) AS TotalComentarios,
          ROUND(SUM(t01_f003)/COUNT(*),2) AS Promedio  
          FROM listar_productos_mejor_valorados ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->ProductoKey                       =   $row->ProductoKey;
          $Obj->ProductoCodigo                    =   $row->codigo;
          $Obj->ProductoDescripcion               =   $row->desc_producto;
          $Obj->ProductoDescripcionLargaKey       =   $row->producto_id_desc_larga;
          $Obj->ProductoCategoriaKey              =   $row->categoria;
          $Obj->ProductoSubcategoriaKey           =   $row->subcategoria;
          $Obj->ProductoMarcaKey                  =   $row->producto_id_marca;
          $Obj->ProductoPrecio                    =   $row->precio;
          $Obj->ProductoDescuento                 =   $row->descuento_producto;
          $remates = $Obj->ProductoCategoriaKey == "A8" ? true : false;
          $Obj->Descuento                         =   $this->Tool->CalcularDescuento($row->descuento_producto);
          $Obj->ProductoExistencia                =   $row->existencia;
          $Obj->ProductoInformacionTecnica        =   $row->info_tecnica;
          $Obj->ProductoPesosDimensiones          =   $row->pesos_dimensiones;
          $Obj->ProductoInformacionAdicional      =   $row->info_adicional;
          $Obj->ProductoRelacionados              =   $row->productos_relacionados;
          $Obj->ProductoCodigoConfigurable        =   $row->codigo_configurable;
          $Obj->ProductoActivo                    =   $row->producto_activo;
          $Obj->ProductoManejado                  =   $row->manejado_por;
          $Obj->ProductoImgPrincipal              =   $row->img_principal;
          $Obj->DescripcionLarga                  =   $row->desc_larga;
          $Obj->CategoriaFamiliaDescripcion       =   $row->desc_familia;
          $Obj->CategoriaActivo                   =   $row->categoria_activo;
          $Obj->CategoriaMenu1                    =   $row->menu1;
          $Obj->CategoriaMenu2                    =   $row->menu2;
          $Obj->CategoriaFolderName               =   $row->folder_name;
          $Obj->CategoriaDescripcion              =   $row->categoria_descripcion;
          $Obj->SubcategoriaDescripcion           =   $row->desc_subcategoria;
          $Obj->SubcategoriaSubnivel              =   $row->subnivel;
          $Obj->SubcategoriaActivo                =   $row->subcategoria_activo;
          $Obj->SubcategoriaDescripcionAdicional  =   $row->subcategoria_descripcion;
          $Obj->MarcaDesripcion                   =   $row->desc_marca;
          $Obj->FichaKey                          =   $row->ficha_id;
          $Obj->FichaRuta                         =   $row->ruta;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListByProductosFijos($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_productos_fijos ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->ProductoKey                       =   $row->id;
          $this->ProductoCodigo                    =   $row->codigo;
          $this->ProductoCodigoWhitOutSlash        =   str_replace("/", "-",$row->codigo);
          $this->ProductoDescripcion               =   $row->desc_producto;
          $this->ProductoCeo                       =   $row->desc_ceo;
          $this->ProductoDescripcionLargaKey       =   $row->producto_id_desc_larga;
          $this->ProductoCategoriaKey              =   $row->categoria;
          $this->ProductoSubcategoriaKey           =   $row->subcategoria;
          $this->ProductoMarcaKey                  =   $row->producto_id_marca;
          $this->ProductoPrecio                    =   $row->precio;
          $this->ProductoDescuento                 =   $row->descuento_producto;
          $remates = $this->ProductoCategoriaKey == "A8" ? true : false;
          $this->Descuento                         =   $this->Tool->CalcularDescuento($row->descuento_producto);
          $this->ProductoExistencia                =   $row->existencia;
          $this->ProductoInformacionTecnica        =   $row->info_tecnica;
          $this->ProductoPesosDimensiones          =   $row->pesos_dimensiones;
          $this->ProductoInformacionAdicional      =   $row->info_adicional;
          $this->ProductoRelacionados              =   $row->productos_relacionados;
          $this->ProductoCodigoConfigurable        =   $row->codigo_configurable;
          $this->ProductoActivo                    =   $row->producto_activo;
          $this->ProductoManejado                  =   $row->manejado_por;
          $this->ProductoImgPrincipal              =   $row->img_principal;
          $this->ProductoCostoEnvio                =   $row->costo_envio;
          $this->DescripcionLarga                  =   $row->desc_larga;
          $this->CategoriaFamiliaDescripcion       =   $row->desc_familia;
          $this->CategoriaActivo                   =   $row->categoria_activo;
          $this->CategoriaMenu1                    =   $row->menu1;
          $this->CategoriaMenu2                    =   $row->menu2;
          $this->CategoriaFolderName               =   $row->folder_name;
          $this->CategoriaDescripcion              =   $row->categoria_descripcion;
          $this->SubcategoriaDescripcion           =   $row->desc_subcategoria;
          $this->SubcategoriaSubnivel              =   $row->subnivel;
          $this->SubcategoriaActivo                =   $row->subcategoria_activo;
          $this->SubcategoriaDescripcionAdicional  =   $row->subcategoria_descripcion;
          $this->MarcaDesripcion                   =   $row->desc_marca;
          $this->FichaKey                          =   $row->ficha_id;
          $this->FichaRuta                         =   $row->ruta;
          $this->MetaKey                           =   $row->meta_key;
          $this->MetaDescription                   =   $row->meta_description;
          $this->Certificado                       =   $this->ExistCert($row->codigo);
          $this->Leyenda                           =   $row->leyenda;
          $this->MinimoCompra                      =   $row->cantidad_minima;

          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ExistCert($codigo){
      try {
        $codigo1="";
        $file="";
        foreach(glob('../../public/images/img_spl/certificados/*.pdf') as $image) {
				$path_parts = pathinfo($image);
				$file=$path_parts['filename'];
				if (preg_match("#$file#i",$codigo)) {
				   $codigo1=$image;
				} 
           }
        return $codigo1;
     
      } catch (Exception $e) {
        throw $e;
      }

    }


  }