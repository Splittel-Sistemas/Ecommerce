<button type="button" id="<?php echo $_GET['id'] ?>" onclick="Verificar3DSecure(this)">Continuar</button>

<script>
  var Verificar3DSecure = function(Elem){
    window.parent.location.href = "../verificar.php?id="+Elem.id
  } 
</script>