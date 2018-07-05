<?php

// print_r($_GET);

include_once 'db.php';

$ano = $_GET['ano'];
$mes = $_GET['mes'];
$buscar = $_GET['buscar'];

if($ano == "todos" && $mes != "todos"){
    $data = $mes;
    $where = "where SUBSTRING(data,6,2) = '$data'";
}

if($ano != "todos" && $mes == "todos"){
    $data = $ano;
    $where = "where SUBSTRING(data,1,4) = '$data'";
}

if($ano == "todos" && $mes == "todos"){
    $where = "";
}
if($ano != "todos" && $mes != "todos"){
    //echo "ok";
    $data = $ano.'-'.$mes;
    $where = "where SUBSTRING(data,1,7) = '$data'";
}

        
$query = mysql_query("SELECT * FROM tb_pdf $where");

if($buscar != ""){
    
    $acao = "pesquisapalavra";
    
    while ($dados = mysql_fetch_array($query)){
        $arquivo = $dados['arq_txt']; //ARQUIVO TXT A SER PESQUISADO
        $ponteiro = fopen($arquivo, "r"); //ABRE O ARQUIVO

        $conteudo = fread($ponteiro, filesize($arquivo)); //LÊ

        $procura = strripos($conteudo, $buscar);

        if ($procura !== false) {
            $pdfi = $pdfi+1; //contador para pdf
            $pdf[$pdfi] = $dados['id'];
        }

        fclose($ponteiro); //FECHA O ARQUIVO
    }//fim while
}else{
    $acao = "somentedata";
}

function data($data){
    $data = explode("-", $data);
    $data = $data[2].'/'.$data[1].'/'.$data[0];
    return $data;
}

switch ($acao){

    case "pesquisapalavra":
        
        
        
            $count_pdf = count($pdf);     
            for($i = 1; $i <= $count_pdf; $i++){
            $query = mysql_query("SELECT * FROM tb_pdf where id = '$pdf[$i]'");
            $ln = mysql_fetch_array($query);
            
            if($ln != ""){
        ?>

        <tr>
            <td align="left"><?= data($ln['data']); ?></td>
            <td style="text-transform:uppercase;" align="left"><?= htmlentities($ln['nome']); ?></td>
            <td style="text-transform:uppercase;" align="left">
                <a href="<?= $ln['arq_pdf']; ?>" target="_blank">Baixar</a>
            </td>
        </tr>

            <?php }}

    break;

    case "somentedata":
        
        while($ln = mysql_fetch_array($query)){ 
        
            if($ln != ""){
        ?>
            <tr>
                <td align="left"><?= data($ln['data']); ?></td>
                <td style="text-transform:uppercase;" align="left"><?= htmlentities($ln['nome']); ?></td>
                <td style="text-transform:uppercase;" align="left">
                    <a href="<?= $ln['arq_pdf']; ?>" target="_blank">Baixar</a>
                </td>
            </tr>

        <? }}

    break;
}
?>