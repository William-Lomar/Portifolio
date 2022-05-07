<?php 
  $local = @$_GET['local'];
  include('php/inputs.php');
?>

<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL?>css/album.css">
<div class="slide">

  <main role="main">
   <form method="post" enctype="multipart/form-data">
    <section class="jumbotron text-center">
      <div class="container">
        
        <?php
        if (isset($_GET['box'])) {
          # code...
          ?>
          <span class="editar">
          <?php
        }
        ?>
        
        <h1 class="titulo">
         
        <?php
         if (isset($_GET['box'])) {
           # code...
          $sql = MySql::conectar()->prepare("SELECT * FROM `tb_titulos` WHERE local = ?");
          $sql->execute(array($local));
          $dados = $sql->fetch();
          echo $dados['titulo'];

          ?><i style="font-size: 30px; margin-left: 10px;" aria-hidden="true"></i>
            </h1>
            </span>
            <input class="tituloHidden" type="text" name="novoTitulo" style="display: none;">
          <?php
         }else{
          echo ucfirst($local); 
          ?>
            </h1>
          <?php
         }
         ?>
        <p class="lead text-muted">Gerencie aqui suas fotos</p>
        <p>
            <input type="file" name="foto[]" multiple="multiple">
        </p>
        <p>
          <button type="submit" name="adicionarFoto" class="btn btn-primary my-2">
            Adicionar foto
          </button>
        
        <?php
          if (isset($_GET['box'])) {
            # code...
            ?>
              <button type="submit" name="editarTitulo" class="btn btn-secondary my-2">
                Editar titulo
              </button>
            <?php
          }
        ?>
        </p>
      </div>
    </section>
    
      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            <?php  InserirBoxPanel($local);  ?>
          </div>
        </div>
      </div>
    </form> 
  </main>
</div>
