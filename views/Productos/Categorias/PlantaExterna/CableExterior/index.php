<?php
  if ($_GET['codigo'] == 'C5') {
    include 'ADDS.php';    
  }elseif ($_GET['codigo'] == 'C7') {
    $_SESSION['FamiliaCable'] = "";
    include 'MicroCable.php';
  }elseif ($_GET['codigo'] == 'C9') {
    $_SESSION['FamiliaCable'] = "";
    include 'Drop.php';
  }else{
    include 'Exterior.php';
  }