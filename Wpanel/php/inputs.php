<?php 
if (isset($_POST['apagar'])) {
  # code...

  Painel::deleteFile($local,$_POST['apagar']);
   if (isset($_GET['box'])) {
    # code...
    Painel::redirecionar(INCLUDE_PATH_PAINEL.'fotos?local='.$local.'&box=true');
  }else{
    Painel::redirecionar(INCLUDE_PATH_PAINEL.'fotos?local='.$local);
  }
}

if (isset($_POST['destaque'])) {
  # code...

  $foto = $_POST['destaque'];

  $nomeOriginal = BASE_DIR."/img/".$local."/".$foto;
  $novoNome = BASE_DIR."/img/".$local."/Destaque.jpg";

  if (verificaNome($local,'Destaque.jpg')) {
    # code...
    rename($nomeOriginal, $novoNome);
    Painel::redirecionar('http://localhost/Atividades/Clientes/Iara/Iara_serv/wpanel/fotos?local='.$local.'&box=true');
  }else{
    ?>
      <script type="text/javascript">
        alert('Já existe uma foto com este nome');
      </script>
    <?php
    Painel::redirecionar(INCLUDE_PATH_PAINEL.'fotos?local='.$local.'&box=true');
  }
}

if (isset($_POST['editar'])) {
  # code... 

  $dadosEditar = explode('/',$_POST['editar']);
  // 0 -> nome da foto
  // 1 -> localização da foto

  $nomeOriginal = BASE_DIR."/img/".$local."/".$dadosEditar[0];
  $novoNome = BASE_DIR."/img/".$local."/".$_POST['novoNome'.$dadosEditar[1]].".jpg";


  if (verificaNome($local,$_POST['novoNome'.$dadosEditar[1]].".jpg")) {
    # code...
      rename($nomeOriginal, $novoNome);

     if (isset($_GET['box'])) {
      # code...
      Painel::redirecionar('http://localhost/Atividades/Clientes/Iara/Iara_serv/wpanel/fotos?local='.$local.'&box=true');
    }else{
      Painel::redirecionar('http://localhost/Atividades/Clientes/Iara/Iara_serv/wpanel/fotos?local='.$local);
    }
  }else{
      ?>
        <script type="text/javascript">
          alert('Já existe uma foto com este nome');
        </script>
      <?php
      Painel::redirecionar(INCLUDE_PATH_PAINEL.'fotos?local='.$local.'&box=true');
    }
  }


if (isset($_POST['adicionarFoto'])) {
  # code...
  $foto = $_FILES['foto'];

  $quantidadeFotos = count($foto['name']);

  for ($i = 0 ; $i < $quantidadeFotos ; $i++) { 
    # code...
    $img['tmp_name'] = $foto['tmp_name'][$i];
    $img['name'] = $foto['name'][$i];
    $img['type'] = $foto['type'][$i];

    if (verificaNome($local,$img['name'])) {
      # code...
        if (Painel::imagemValida($img)) {
        # code...
        Painel::uploadFile($img,$local);
      }else{
        continue;
      }
    }else{
      $repetidas[] = $img['name']; 
      continue;
    }

  }

  if (@count($repetidas) > 0) {
    # code...
    ?>
      <script type="text/javascript">
        alert('Imagem <?php foreach ($repetidas as $key => $value){
          echo $value;
          echo ' ';
        }  ?>com nome repetido');
      </script>
    <?php
  }

/*
  if (isset($_GET['box'])) {
    # code...
    Painel::redirecionar(INCLUDE_PATH_PAINEL.'fotos?local='.$local.'&box=true');
  }else{
    Painel::redirecionar(INCLUDE_PATH_PAINEL.'fotos?local='.$local);
  } */
}

if (isset($_POST['editarTitulo'])) {
  # code...
    $arr = [
    'nome_tabela'=>'tb_titulos',
    'titulo'=>$_POST['novoTitulo'],
    'id'=>$dados['id']
  ];

  if (Painel::update($arr)) {
    Painel::redirecionar(INCLUDE_PATH_PAINEL.'fotos?local='.$local.'&box=true');
   } 
}
?>
