<?php 
  Painel::https();

  include('config.php');
  Painel::updateUsuariosOnline();
  Painel::contador();
?>

<!DOCTYPE html>
<html> 
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171949187-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-171949187-1');
  </script>
 
  <title>Iara Pires</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="fotografa, bebe, serra, vitoria, ensaios fotograficos, laranjeiras, newborn, gestação">
  <meta name="description" content="Fotografa profissional, fotos newborn, gestação e familias">
  <meta charset="utf-8">
  <link rel="shortcut icon" href="<?php echo INCLUDE_PATH?>logos/logoicon.png">
  <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH?>style.css?hash=<?php echo filemtime(BASE_DIR.'/style.css');?>">
</head>
<body> 
  <script type="text/javascript" src="<?php echo INCLUDE_PATH?>js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo INCLUDE_PATH?>js/functions.js"></script>
  <script type="text/javascript" src="<?php echo INCLUDE_PATH?>js/slider.js"></script>
<header>
  <div class="img-header">
    <img src="<?php echo INCLUDE_PATH?>logos/nova-logo.png"> 
  </div>

  <div class="topicos">
    <ul>
      <li><a href="<?php echo INCLUDE_PATH?>home">HOME</a></li>
      <li><a href="<?php echo INCLUDE_PATH?>trabalhos">TRABALHOS</a></li>
      <li><a href="<?php echo INCLUDE_PATH?>bio">BIOGRAFIA</a></li>
      <li><a href="<?php echo INCLUDE_PATH?>contatos">CONTATOS</a></li>
    </ul>
  </div>
  <div class="clear"></div>

</header>
  <?php

    $url = isset($_GET['url']) ? $_GET['url'] : 'home';
    switch ($url) {
      case 'home':
        echo '<target target="home" />';
        break;

      case 'trabalhos':
        echo '<target target="trabalhos" />';
        break;

      case 'biografia':
        echo '<target target="biografia" />';
        break;

      case 'contatos':
        echo '<target target="contatos" />';
        break;
    }
  ?>
 <?php 
  if (file_exists('pg/'.$url.'.php')) {
      include('pg/'.$url.'.php');
    }else{
      include('pg/home.php');
    }
?>
<footer>
  <a href="https://www.doublesix.com.br/" target="_blanck"><h1> ©2020 Desenvolvido por DoubleSix</h1></a>
</footer>
</body>
</html>
