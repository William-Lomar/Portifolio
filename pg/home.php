<?php   
  $sql = MySql::conectar()->prepare("SELECT * FROM `tb_titulos`");
  $sql->execute();
  $dados = $sql->fetchAll();   
?>
<section class="banner">
  <?php InserirSlide("img/slide") ?>
</section><!--banner-->

<section class="servicos" id="trabalhos">

<div class="titulo">
  <h1>Trabalhos</h1>
</div>

  <?php 
    for ($i=1 ; $i <= 6; $i++) { 
      ?>
        <a href="<?php echo INCLUDE_PATH?>box?local=box<?php echo $i ?>">
          <div class="img-princ princ<?php echo $i ?>" style="background-image: url('img/box<?php echo $i ?>/Destaque.jpg?hash=<?php echo filemtime(BASE_DIR.'/img/box'.$i.'/Destaque.jpg'); ?>');">
           <div class="black black<?php echo $i ?>">
             <h1><?php echo $dados[$i-1]['titulo']?></h1>
           </div> 
          </div>
        </a>
      <?php
    }
  ?>

</section><!--servicos-->

<section class="destaque">
  <div class="titulo">
    <h1>Destaque</h1>
  </div>
  <?php 
    InserirBox("img/destaque","imgDestaque");
  ?>
</section>
  


