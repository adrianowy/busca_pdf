<?
$path = "pdf/";
$diretorio = dir($path);
    
// echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";    
while($arquivo = $diretorio -> read()){
    $arquivo = trim($arquivo);
    if($arquivo != "." && $arquivo != ".."){
        $i = $i+1;
        $notas[$i] = $arquivo;
    }
    // echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
}
$diretorio -> close();

echo '<pre>';
print_r($notas);

$cont = count($notas); //verificar quantos elementos tem no array notas


$busca = "ciclo"; //NOME E A SER PESQUISADA NA BASE DE DADOS TXT

for($i = 1; $i <= $cont; $i++){

    $arquivo = $path.$notas[$i]; //ARQUIVO TXT A SER PESQUISADO
    $ponteiro = fopen($arquivo, "r"); //ABRE O ARQUIVO

    $conteudo = fread($ponteiro, filesize($arquivo) ); //LÊ
    
    
    $procura = strripos($conteudo, $busca);

    if ($procura !== false) {
        $pdfi = $pdfi+1; //contador para pdf
        $pdf[$pdfi] = $notas[$i];
    }

    fclose($ponteiro); //FECHA O ARQUIVO

}

//print_r($pdf);

$cont_pdf = count($pdf);
for($i = 1; $i <= $cont_pdf; $i++){
    echo "<br/>Existe as palavras nos seguinte arquivos:".$pdf[$i].'<br/>';
}


//echo $conteudo;

//EXPLODE AS LINHAS QUANDO PULAR LINHA
//$linha = explode("", $conteudo);

//for($i = 0; $i <= sizeof($linha); $i++) {
 //SEPARANDO OS DADOS POR; (PONTO E VIRGULA)
 //echo $linha[$i];
 //$parte = explode(";", $linha[$i]);
 //NOME DO USUÁRIO
 //$parte_user = trim($parte[0]);

 //VERIFICA SE O USUÁRIO DIGITADO EXISTE
    //if( ($usuario == $parte_user) ) {
    //SOMA A VARIÁVEL EXISTE
    //$existe++;
    //}//FECHA IF
//}//FECHA FOR

//VERIFICA O RESULTADO
//if($existe)
// echo "O usuário $pesq_usuario <b>EXISTE</b>
//em nossa base de dados.";
//else
// echo "O usuário $pesq_usuario <b>NÃO
//EXISTE</b> em nossa base de dados.";


?>