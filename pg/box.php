<?php 
  $local = $_GET['local'];
  $sql = MySql::conectar()->prepare("SELECT * FROM `tb_titulos` WHERE local = ?");
  $sql->execute(array($local));
  $dados = $sql->fetch();  
?> 

<div class="conteudo">
  <h1><?php echo $dados['titulo'] ?></h1>
  <?php InserirBox("img/".$local,"w50 inline"); ?>
</div>
