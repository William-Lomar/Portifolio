<?php
  include('Wpanel/WideImage/lib/WideImage.php');

  define('INCLUDE_PATH',"https://seu_caminho/Portifolio/");
  define('BASE_DIR',__DIR__);
  define("INCLUDE_PATH_PAINEL", 'https://seu_caminho/Portifolio/Wpanel/');

  //setar timezone
  date_default_timezone_set('America/Sao_Paulo');

  session_start();

    //incluir classes dinamicamente
  $autoload = function($class){
    include('class/'.$class.'.php');
  };

  spl_autoload_register($autoload);

  //Conectar com banco de dados
  define('HOST',"seu_host");
  define("USER", "seu_usuario");
  define("PASS", "sua_senha");
  define("DB", "sua_database");

  function InserirSlide($dir){
    
  $diretorio = scandir($dir);

    foreach ($diretorio as $key => $value) {
  if ($key == 0 || $key == 1) {
          continue;
        }
      ?>
 <div style = "background-image:url('<?php echo INCLUDE_PATH.$dir.'/'.$value.'?hash='.filemtime(BASE_DIR.'/'.$dir.'/'.$value)?>');" class="img-banner"></div>
      <?php  
}
  }

  function InserirBox($dir,$class){
     $diretorio = scandir($dir);

    foreach ($diretorio as $key => $value) {
    if ($key == 0 || $key == 1) {
            continue;
          }
        ?>
        <div class="<?php echo $class ?>">
         <img src="<?php echo INCLUDE_PATH.$dir.'/'.$value.'?hash='.filemtime(BASE_DIR.'/'.$dir.'/'.$value)?>">
        </div>
        <?php  
    }
  }

  function InserirBoxPanel($dir){
    $diretorio = scandir(BASE_DIR.'/img/'.$dir);

    foreach ($diretorio as $key => $value) {
      if ($key == 0 || $key == 1) {
        continue;
      }

      $nomeImg = explode('.', $value);
      $slug = Painel::generateSlug($nomeImg[0]);

      ?>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
       <img src="<?php echo INCLUDE_PATH ?>/img/<?php echo $dir.'/'.$value.'?hash='.filemtime(BASE_DIR.'/img/'.$dir.'/'.$value) ?>" class="img"> 
        <div class="card-body"> 
          <p class="card-text" arquivo = "<?php echo $slug ?>"><span class="editar"><?php echo $nomeImg[0] ?> <i aria-hidden="true"></i></span></p> 
          <input class="<?php echo $slug ?>" style="margin-bottom: 16px; display: none;" type="text" name="novoNome<?php echo $key ?>" value="<?php echo $nomeImg[0] ?>"> 
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button value="<?php echo $value ?>" name="apagar" type="submit" class="btn btn-sm btn-outline-secondary">Apagar</button>
             <button value="<?php echo $value.'/'.$key ?>" name="editar" type="submit" class="btn btn-sm btn-outline-secondary">Editar Nome</button> 
              <?php if (isset($_GET['box'])) {
                # code...
                ?>
                <button value="<?php echo $value ?>" name="destaque" type="submit" class="btn btn-sm btn-outline-secondary">Destaque</button>
              <?php
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
    }
  }

  function verificaNome($dir,$nome){
    $diretorio = scandir(BASE_DIR.'/img/'.$dir);
    $tag = true;

    foreach ($diretorio as $key => $value) {
      if ($key == 0 || $key == 1) {
        continue;
      }

      if ($value == $nome) {
        $tag = false;
        break;
      }
    }

    return $tag;
  }

?>
