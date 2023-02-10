<?php
  if ($_GET['codigo'] == 'C5') {
    include 'ADDS.php';    
  }elseif ($_GET['codigo'] == 'C7') {
    $_SESSION['FamiliaCable'] = "";
    include 'MicroCable.php';
  }elseif ($_GET['codigo'] == 'C9') {
    $_SESSION['FamiliaCable'] = "";
    include 'Drop.php';
  }elseif ($_GET['codigo'] == 'C91') {
    $_SESSION['FamiliaCable'] = "";
    include 'ADSSA.php';
  }elseif ($_GET['codigo'] == 'C92') {
    $_SESSION['FamiliaCable'] = "";
    include 'ADSSR.php';
  }elseif ($_GET['codigo'] == 'C98') {
    $_SESSION['FamiliaCable'] = "";
    include 'ADSSMN.php';
  }elseif ($_GET['codigo'] == 'C99') {
    $_SESSION['FamiliaCable'] = "";
    include 'ADSSAP.php';
  }elseif ($_GET['codigo'] == 'C8') {
    include 'MiniFigura8.php';
  }else{
    include 'Exterior.php';
  }