<?php

include('../config.php');

if (Painel::logado() == false) {
  # code...
  include('login.php');
}else{
  include('home.php');
}

?>
