<?php 
  $usuariosOnline = Painel::listarUsuariosOnline();

  $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_visitas`");
  $pegarVisitasTotais->execute();
  $totaldeVisitas = $pegarVisitasTotais->rowCount();

  $pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_visitas` WHERE dia = ?");
  $pegarVisitasHoje->execute(array(date("Y-m-d")));
  $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>
<div class="introducao">
  <h1>Bem vindo à seu Painel!!</h1> 

  <div class="container dados">
    <div class="row bold">
      <div class="col-md-4">Usuários Online</div>
      <div class="col-md-4">Total de Visitas</div>
      <div class="col-md-4">Visitas Hoje</div>
    </div>
    <div class="row">
      <div class="col-md-4"><?php echo count($usuariosOnline) ?></div>
      <div class="col-md-4"><?php echo $totaldeVisitas?></div>
      <div class="col-md-4"><?php echo $pegarVisitasHoje?></div>
    </div>
  </div>

  <h1>Usuários Online</h1>
  <div class="container dados">
    <div class="row bold">
      <div class="col-md-6">IP</div>
      <div class="col-md-6">Ultima ação</div>
    </div>

    <?php
      foreach ($usuariosOnline as $key => $value) {
        # code...
        ?>
      <div class="row">
          <div class="col-md-6"><?php echo $value['ip']?></div>
          <div class="col-md-6"><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao']))?></div>
        </div>
      
        <?php
      }
      ?>
  </div>
</div>
