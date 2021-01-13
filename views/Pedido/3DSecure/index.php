<button type="button" id="<?php echo $_GET['id'] ?>" onclick="Verificar3DSecure()">Continuar</button>

<script>
  var Verificar3DSecure = function(){
    window.parent.location.href = "../Pedido/3DSecure/Completado.php"
  } 
</script>