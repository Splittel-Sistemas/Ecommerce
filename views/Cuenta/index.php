<?php 
  @session_start();
  if(!isset($_SESSION['Ecommerce-ClienteKey'])){
    header('Location: ../Home');
  }else{
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php 
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php';     
    ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
     <style type="text/css">
      .dt-button.mystylebutton {
        height: 36px;
        background: #BF202F;
        color: white;
        min-width: 64px;
        border: none;
        margin-bottom: 20px;
      }
    </style>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <!-- Content -->
    <?php
      if (isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Cuenta/B2C/index.php'; 
      }else{
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Cuenta/B2B/index.php'; 
      }
    ?>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Cuenta/Micuenta.js?id=<?php echo rand();?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/B2B/General.js?id=<?php echo rand();?>"></script>
    <script type="text/javascript" src="../../public/scripts/Login/login.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/B2C/datos_envio.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/B2C/datos_facturacion.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/B2C/Documento.js?id=<?php echo rand();?>"></script>
    <script type="text/javascript" src="../../public/scripts/Cuenta/B2C/Pendientes.js?id=<?php echo rand();?>"></script>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Cuenta/B2B/Cotizaciones.js?id=<?php echo rand();?>"></script>

    <?php if (isset($_GET['pedido'])): ?>
    <script type="text/javascript">
      Menu(document.getElementById('PendientesLink'))
    </script>
    <?php endif ?>
     <script type="text/javascript">
      var listDataEnvioB2B = function(){
         ajax_("../../views/Cuenta/B2B/DatosEnvio/index.php", "POST", "HTML",
        {
        }, 
        function(response) {
          document.getElementById('ContenidoCuenta').innerHTML = response
          GlobalInitialDatatableSimple('TableGetShipToAdress');
        })
      }

      var deleteDataEnvioB2B = function(Elem){
        let NombreDireccion = Elem.id
        ajax_("../../models/WebService/BussinesPartner/DeleteAddressBussinesPartner.php", "POST", "JSON",
        {
          Action: 'create',
          ActionEnvio: true,
          TipoDireccion: 'ShipTo',
          NombreDireccion: NombreDireccion,
        }, 
        function(response) {
          response = response.DeleteAddressBussinesPartnerResult
          if (response.ErrorCode == 0) {
            templateAlert(response.ErrorType, "", 'Eliminado exitosamente', "topRight", "icon-check-circle")
            listDataEnvioB2B()
          }else{
            templateAlert('danger', "", 'No se pudo registrar!', "topRight", "icon-slash")
          }
        })
      }

      var sendDataEnvioB2B = function(elem) {
        let NombreDireccion = document.getElementById('NombreDireccion')
        let Calle = document.getElementById('Calle')
        let NumeroExterior = document.getElementById('NumeroExterior')
        let Colonia = document.getElementById('Colonia')
        let CodigoPostal = document.getElementById('CodigoPostal')
        let Estado = document.getElementById('Estado')
        let Delegacion = document.getElementById('Delegacion')
        let x = document.getElementById("Estado").selectedIndex;
        let y = document.getElementById("Estado").options;
        let EstadoDescripcion = y[x].text
        
        ajax_("../../models/WebService/BussinesPartner/AddNewAddressBussinesPartner.php", "POST", "JSON",
        {
          Action: 'create',
          ActionEnvio: true,
          TipoDireccion: 'ShipTo',
          NombreDireccion: NombreDireccion.value,
          Calle: Calle.value,
          NumeroExterior: NumeroExterior.value,
          Colonia: Colonia.value,
          CodigoPostal: CodigoPostal.value,
          Estado: Estado.value,
          EstadoDescripcion: EstadoDescripcion,
          Delegacion: Delegacion.value
        }, 
        function(response) {
          response = response.AddNewAddressBussinesPartnerResult
          if (response.ErrorCode == 0) {
            templateAlert(response.ErrorType, "", 'Registrado exitosamente', "topRight", "icon-check-circle")
            modal.close()
            listDataEnvioB2B()
          }else{
            templateAlert('danger', "", 'No se pudo registrar!', "topRight", "icon-slash")
          }
        })
      }

      var updateDataEnvioB2B = function(Elem) {
        let NombreDireccion = Elem.getAttribute('AddressName')
        let Calle = document.getElementById('Calle')
        let NumeroExterior = document.getElementById('NumeroExterior')
        let Colonia = document.getElementById('Colonia')
        let CodigoPostal = document.getElementById('CodigoPostal')
        let Estado = document.getElementById('Estado')
        let Delegacion = document.getElementById('Delegacion')
        let x = document.getElementById("Estado").selectedIndex;
        let y = document.getElementById("Estado").options;
        let EstadoDescripcion = y[x].text

        ajax_("../../models/WebService/BussinesPartner/UpdateAddressBussinesPartner.php", "POST", "JSON",
        {
          Action: 'create',
          ActionEnvio: true,
          TipoDireccion: 'ShipTo',
          NombreDireccion: NombreDireccion,
          Calle: Calle.value,
          NumeroExterior: NumeroExterior.value,
          Colonia: Colonia.value,
          CodigoPostal: CodigoPostal.value,
          Estado: Estado.value,
          EstadoDescripcion: EstadoDescripcion,
          Delegacion: Delegacion.value
        }, 
        function(response) {
          response = response.UpdateAddressBussinesPartnerResult
          if (response.ErrorCode == 0) {
            templateAlert(response.ErrorType, "", 'Actualizado exitosamente', "topRight", "icon-check-circle")
            modal.close()
            listDataEnvioB2B()
          }else{
            templateAlert('danger', "", 'No se pudo registrar!', "topRight", "icon-slash")
          }
        })
      }

      var showFormNewDatosEnvioB2B = function(elem){
        ajax_(
        "../../views/Cuenta/B2B/DatosEnvio/create.php", 
        "post", 
        "html", 
        { }, 
        function(response) {
          modal.open();
          modal.setContent(response);
        })
      }

      var showFormEditDatosEnvioB2B = function(Elem){
        ajax_(
        "../../views/Cuenta/B2B/DatosEnvio/create.php", 
        "post", 
        "html", 
        { AddressName: Elem.id }, 
        function(response) {
          modal.open();
          modal.setContent(response);
        })
      }
    </script>
  </body>
</html>
<?php } ?>