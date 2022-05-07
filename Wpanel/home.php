<?php 
  if (!isset($_SESSION['login'])){
    header("Location:http://caminho_login/wpanel/");
  }

  $url = isset($_GET['url']) ? $_GET['url'] : 'geral';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Wpanel - Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL?>css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL?>css/style.css?hash=<?php echo filemtime(BASE_DIR.'/Wpanel/css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL?>css/icones/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo INCLUDE_PATH ?>">Iara Pires</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if($url == 'geral') echo 'active';  ?>" href="<?php echo INCLUDE_PATH_PAINEL?>geral">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(@$_GET['local'] == 'slide') echo 'active';  ?>" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=slide">Slide</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php  if (isset($_GET['box'])) echo 'active';?>" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
              if (isset($_GET['local'])) {
                # code...
                switch ($_GET['local']) {
                  case 'box1':
                    # code...
                  echo 'Box1';
                    break;

                  case 'box2':
                    # code...
                  echo 'Box2';
                    break;
                
                  case 'box3':
                    # code...
                  echo 'Box3';
                    break;

                  case 'box4':
                    # code...
                  echo 'Box4';
                    break;

                  case 'box5':
                    # code...
                  echo 'Box5';
                    break;

                  case 'box6':
                    # code...
                  echo 'Box6';
                    break; 

                  default:
                  echo "Boxs";
                    break; 
                  }
                }else{
                  echo "Boxs";
                }
            ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=box1&box=true">Box1</a>
            <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=box2&box=true">Box2</a>
            <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=box3&box=true">Box3</a>
            <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=box4&box=true">Box4</a>
            <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=box5&box=true">Box5</a>
            <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=box6&box=true">Box6</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(@$_GET['local'] == 'destaque') echo 'active';  ?>" href="<?php echo INCLUDE_PATH_PAINEL?>fotos?local=destaque">Destaques</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <form method="post">
            <button name="sair" type="submit" class="btn btn-light">Sair</button>
          </form>
          <?php
            if (isset($_POST['sair'])) {
            # code...
            # code... time()-1 -> serve para destruir cookie
            setcookie('lembrar');//'/'-> significa que é para pegar em todo o site, setcookie e somente o seu nome o deleta
            session_destroy();
            header("Location:http://localhost/Atividades/Clientes/Iara/Iara_serv/wpanel/");
          }
          ?>
        </li>
      </ul>
    </div>
  </nav>

  <section class="conteudo">
    <?php 
      if(file_exists('pg/'.$url.'.php')){
       include('pg/'.$url.'.php');
      }else{
        include('pg/geral.php');
      }
    ?>
  </section>

<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL?>js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>js/main.js"></script>
</body>
</html>
