<?php

  class Painel{
    public static function https(){
      if ($_SERVER['HTTPS'] != "on"){
        self::redirecionar(INCLUDE_PATH.$_GET['url']);
      }
    }

    public static function limparUsuariosOnline(){
      $date = date("Y-m-d H:i:s");
      $sql = MySql::conectar()->exec("DELETE FROM `tb_online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE");
    }

    public static function listarUsuariosOnline(){
      self::limparUsuariosOnline();
      $sql = MySql::conectar()->prepare("SELECT * FROM `tb_online`");
      $sql->execute();
      return $sql->fetchAll();
    }

    public static function contador(){
        if (!isset($_COOKIE['visita'])) {
          //setcookie("nome","oq tem dentro","quanto tempo ele vai existir(em segundos)")
          setcookie('visita','true',time() + (60*60*24*7)); //time()-> retorna hora atual em segundos, ai vc soma o tempo desejado em segundos
          $sql = MySql::conectar()->prepare("INSERT INTO `tb_visitas` VALUES (null,?,?)");
          $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
        }
      }

      public static function updateUsuariosOnline(){

      if (isset($_SESSION["online"])) {
        $token = $_SESSION["online"];
        $horarioAtual = date("Y-m-d H:i:s");
        $check = MySql::conectar()->prepare("SELECT `id` FROM `tb_online` WHERE token = ?");
        $check->execute(array($token));

        if ($check->rowCount() == 1) {
          $sql = MySql::conectar()->prepare("UPDATE `tb_online` SET ultima_acao = ? WHERE token = ?");
          $sql->execute(array($horarioAtual,$token));
        }else{
          $ip = $_SERVER['REMOTE_ADDR'];
          $token = $_SESSION['online'];
          $horarioAtual = date('Y-m-d H:i:s');
          $sql = MySql::conectar()->prepare("INSERT INTO `tb_online` VALUES (null,?,?,?)");
          $sql->execute(array($ip,$horarioAtual,$token));
        }

      }else{
        $_SESSION["online"] = uniqid();
        $ip = $_SERVER["REMOTE_ADDR"];
        $token = $_SESSION['online'];
        $horarioAtual = date("Y-m-d H:i:s");
        $sql = MySql::conectar()->prepare("INSERT INTO `tb_online` VALUES (null,?,?,?)");
        $sql->execute(array($ip,$horarioAtual,$token));
      }

    }

    public static function generateSlug($str){
      $str = mb_strtolower($str);
      $str = preg_replace('/(â|á|ã)/', 'a', $str);
      $str = preg_replace('/(ê|é)/', 'e', $str);
      $str = preg_replace('/(í|Í)/', 'i', $str);
      $str = preg_replace('/(ú)/', 'u', $str);
      $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
      $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
      $str = preg_replace('/( )/', '-',$str);
      $str = preg_replace('/ç/','c',$str);
      $str = preg_replace('/(-[-]{1,})/','-',$str);
      $str = preg_replace('/(,)/','-',$str);
      $str=strtolower($str);
      return $str;
    }

    public static function logado(){
      return isset($_SESSION['login']) ? true : false;
    }

    public static function alerta($tipo,$msg){
      if ($tipo == "sucesso") {
        # code...
        echo '<div class="sucesso">'.$msg.'</div>';
      }elseif ($tipo == 'erro') {
        # code...
        echo '<div class="erro">'.$msg.'</div>';
      }
    }

    public static function imagemValida($img){
      if ($img['type'] == 'image/jpg' || 
          $img['type'] == 'image/jpeg' ||
          $img['type'] == 'image/png') {
        return true;
      }else{
        return false;
      }
    }

    public static function uploadFile($file,$local){
      $image = WideImage::load($file['tmp_name']);
      $resized = $image->resize(700);
      if ($resized->saveToFile(BASE_DIR.'/img/'.$local.'/'.$file['name'])) {
        return true;
      }else{
        return false;
      }
    }

    public static function deleteFile($dir,$file){
      @unlink(BASE_DIR.'/img/'.$dir.'/'.$file);
    }

    public static function insert($post,$nomeTabela){
      $tag = true;
      
      $query = "INSERT INTO `$nomeTabela` VALUES (null";
      foreach ($post as $key => $value) {
        if ($key == 'enviar') {
         continue;
        }
        /*if ($value == '') {
          # code...
          $tag = false;
          break;
        }*/
        $query .= ",?";
        $parametros[] = $value;
      }

      $query .= ")";

      
      if ($tag == true) {
        $sql = MySql::conectar()->prepare($query);
        $sql->execute($parametros);
      }
      return $tag;
    }

    public static function selectFilter($tabela,$local,$tipoEmpresa){

      if ($tipoEmpresa == 'geral' && $local == 'total') {

              $dados = self::selectAll($tabela);
              return $dados;
          }elseif ($tipoEmpresa == 'geral' && $local == 'almoxarifado') {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE local <> 'bancada'");
            $sql->execute(); 
          }elseif ($tipoEmpresa == 'geral' && $local == 'bancada') {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE local = 'bancada'");
            $sql->execute();    
          }elseif (($tipoEmpresa == 'iema' || $tipoEmpresa == 'ecosoft') && $local == 'total') {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE empresa = ?");
            $sql->execute(array($tipoEmpresa));
          }elseif (($tipoEmpresa == 'iema' || $tipoEmpresa == 'ecosoft') && $local == 'almoxarifado') {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE empresa = ? AND local <> 'bancada'");
            $sql->execute(array($tipoEmpresa));
          }elseif (($tipoEmpresa == 'iema' || $tipoEmpresa == 'ecosoft') && $local == 'bancada') {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE empresa = ? AND local = 'bancada'");
            $sql->execute(array($tipoEmpresa));
          }elseif($tipoEmpresa == 'clientes' && $local == 'total'){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE empresa <> 'IEMA' AND empresa <> 'Ecosoft'");
            $sql->execute(); 
          }elseif($tipoEmpresa == 'clientes' && $local == 'almoxarifado'){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE empresa <> 'IEMA' AND empresa <> 'Ecosoft' AND local <> 'bancada'");
            $sql->execute(); 
          }elseif($tipoEmpresa == 'clientes' && $local == 'bancada'){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE empresa <> 'IEMA' AND empresa <> 'Ecosoft' AND local = 'bancada'");
            $sql->execute(); 
          }

      return $sql->fetchAll();
    }

     
    public static function selectAll($tabela,$start = null,$end = null){
      if ($start == null && $end == null) {

        $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela`");
      }else{
        
        $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` LIMIT $start,$end");
      }
      $sql->execute();

      return $sql->fetchAll();
    }

    public static function deletar($tabela,$id=false){
      if ($id == false) {
        $sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
      }else{
        $sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = $id");
      }
      $sql->execute();
    }

    public static function redirecionar($url){
      echo "<script>location.href='".$url."'</script>";
      die();
    }

    public static function atualizarPagina(){
      echo "<script>window.location.reload(true)</script>";
      die();
    }

    public static function selecionarID($tabela,$id){
      
      $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE id = ?");
      $sql->execute(array($id));
      $dados = $sql->fetchAll();
      return $dados;
    }

    public static function update($arr,$single = false){
      $certo = true;
      $first = false;
      $nome_tabela = $arr['nome_tabela'];

      $query = "UPDATE `$nome_tabela` SET ";
      foreach ($arr as $key => $value) {
        $nome = $key;
        $valor = $value;
        if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
          continue;
        /*if($value == ''){
          $certo = false;
          break;
        }*/
        
        if($first == false){
          $first = true;
          $query.="$nome=?";
        }
        else{
          $query.=",$nome=?";
        }

        $parametros[] = $value;
      }

      if($certo == true){
        if($single == false){
          $parametros[] = $arr['id'];
          $sql = MySql::conectar()->prepare($query.' WHERE id=?');
          $sql->execute($parametros);
        }else{
          $sql = MySql::conectar()->prepare($query);
          $sql->execute($parametros);
        }
      }
      return $certo;
    }

    public static function validaEquipamento($dataNF,$dataEntrada,$situacao){
      $style = '';
      $dataNF = date_create_from_format('d/m/Y',$dataNF);
      $dataEntrada = date_create_from_format('d/m/Y',$dataEntrada);
      $dataHoje = date("Y-m-d");
      

      $dataEntrada = $dataEntrada->format('Y-m-d');
      $dataNF = $dataNF->format('Y-m-d');

      $intervaloEntrada = (strtotime($dataHoje)-strtotime($dataEntrada))/86400; // dividido por 86400 transforma valor em dias
      $intervaloNF = (strtotime($dataHoje)-strtotime($dataNF))/86400;
      

      if ($intervaloEntrada > 15 && $situacao == 'Ag Avaliação') {
        $style = "background-color: red;";
      }
      
      if ($intervaloNF > 150) {
        $style .=  'color: green;';
      }

      echo $style;
    }

    public static function validaPadrao($dataPadrao){
      $style = '';
      
      $dataPadrao = date_create_from_format("d/m/Y",$dataPadrao);
      
      $dataPadrao = $dataPadrao->format('Y-m-d');
      $dataHoje = date("Y-m-d");

      $intervalo = (strtotime($dataHoje)-strtotime($dataPadrao))/86400;

      
      if ($intervalo > 365) {
        $style = "background-color: red;";
      }

      echo $style;
    }
}

?>
