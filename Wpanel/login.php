<?php 
  if (isset($_COOKIE['lembrar'])) {
    # code...
    $usuario = $_COOKIE['usuario'];
    $senha = $_COOKIE['senha'];

    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuarios` WHERE usuario = ? AND senha = ?");
    $sql->execute(array($usuario,$senha));
    if ($sql->rowCount() == 1) {
      # code...
      $_SESSION['login'] = true;
      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;
      header('Location: '.INCLUDE_PATH_PAINEL);
      die();
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>WPanel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL?>css/bootstrap.min.css">
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL?>css/login.css">
</head>
<body>

<div class="voltarSite">
  <button type="button" class="btn btn-primary"><a href="http://localhost/Atividades/Clientes/Iara/Iara_serv/">Voltar ao site</a></button>
</div>


<form class="form-signin" method="post">
  <div class="text-center mb-4">
    <h1 class="h3 mb-3 font-weight-normal">WPanel</h1>
    <p>Faça login em seu Wpainel</p>
  </div>

  <div class="form-label-group">
    <input type="text" name="usuario" id="inputEmail" class="form-control" placeholder="Usuario" required autofocus>
    <label for="inputEmail">Usuário</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
    <label for="inputPassword">Senha</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me" name="lembrar"> Lembrar senha
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="enviar">Enviar</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy;DoubleSix - 2020</p>
</form>
<?php 
  if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuarios` WHERE usuario = ? AND senha = ?");
    $sql->execute(array($usuario,$senha));
    
    if ($sql->rowCount() == 1) {
      # code...
      //logado com sucesso

      $_SESSION['login'] = true;
      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;
      if (isset($_POST['lembrar'])) {
        # code...
        setcookie('lembrar',true,time()+(60*60*24*10),'');
        setcookie('usuario',$usuario,time()+(60*60*24*10),'');
        setcookie('senha',$senha,time()+(60*60*24*10),'');
      }
      header('Location: '.INCLUDE_PATH_PAINEL);
      die();

    }else{
      //erro ao logar
      ?>
        <script type="text/javascript">
          alert('Usuario ou senha incorretos');
        </script>
      <?php
    }

  }

?>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>js/jquery.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL?>js/bootstrap.min.js"></script> 
</body>
</html>
