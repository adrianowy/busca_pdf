<?php
include_once 'db.php';
echo "<br/>";

function data2($data){
    $data = explode("-", $data);
    $data = $data[2].'/'.$data[1].'/'.$data[0];
    return $data;
}

?>

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>  <!--BIBLIOTECA JQUERY 
<script type="text/javascript" src="js/jquery.dataTables.js"></script>  BIBLIOTECA JQUERY 

<link rel="stylesheet" type="text/css" href="css/demo_table.css" />
<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />-->

<script type="text/javascript" charset="utf-8"> //TABELAS
    $(document).ready(function() {
//        oTable = $('#table').dataTable({
//                "bJQueryUI": true,
//                "sPaginationType": "full_numbers"
//        });
        
        $('#buscar').keyup(function(){
            $('#tbody').load('carregarLista.php?buscar='+$('#buscar').val()+'&ano='+$('#ano').val()+'&mes='+$('#mes').val());
        });
        
        $('#ano').change(function(){
            $('#tbody').load('carregarLista.php?buscar='+$('#buscar').val()+'&ano='+$('#ano').val()+'&mes='+$('#mes').val());
        });
        
        $('#mes').change(function(){
            $('#tbody').load('carregarLista.php?buscar='+$('#buscar').val()+'&ano='+$('#ano').val()+'&mes='+$('#mes').val());
        });
        
    } );
    
    
</script>

<form method="post" action="">
    <select name="ano" id="ano">
        <option value="todos" >Todos</option>
        <option value="2013" <? if(date('Y') == '2013') { echo "selected='selected'";}?>>2013</option>
        <option value="2012" <? if(date('Y') == '2012') { echo "selected='selected'";}?>>2012</option>
        <option value="2011" <? if(date('Y') == '2011') { echo "selected='selected'";}?>>2011</option>
    </select>

    <select name="mes" id="mes">
        <option value="todos" >Todos</option>
        <option value="01" <? if(date('m')== '01') { echo "selected='selected'";}?>>JANEIRO</option>
        <option value="02" <? if(date('m')== '02') { echo "selected='selected'";}?>>FEVEREIRO</option>
        <option value="03" <? if(date('m')== '03') { echo "selected='selected'";}?>>MAR&Ccedil;O</option>
        <option value="04" <? if(date('m')== '04') { echo "selected='selected'";}?>>ABRIL</option>
        <option value="05" <? if(date('m')== '05') { echo "selected='selected'";}?>>MAIO</option>
        <option value="06" <? if(date('m')== '06') { echo "selected='selected'";}?>>JUNHO</option>
        <option value="07" <? if(date('m')== '07') { echo "selected='selected'";}?>>JULHO</option>
        <option value="08" <? if(date('m')== '08') { echo "selected='selected'";}?>>AGOSTO</option>
        <option value="09" <? if(date('m')== '09') { echo "selected='selected'";}?>>SETEMBRO</option>
        <option value="10" <? if(date('m')== '10') { echo "selected='selected'";}?>>OUTUBRO</option>
        <option value="11" <? if(date('m')== '11') { echo "selected='selected'";}?>>NOVEMBRO</option>
        <option value="12" <? if(date('m')== '12') { echo "selected='selected'";}?>>DEZEMBRO</option>
    </select>
    
    <input type="text" name="buscar" id="buscar"/>
    
    <!-- <input name="enviar" value="Filtrar" type="submit"/> -->
</form>


<div id="demo">
<table cellpadding="3" cellspacing="5" border="1" class="display" id="table">
    <thead>
        <tr>
            <th width="" align="left">Data</th>
            <th width="" align="left">Nome</th>
            <th width="" align="left">Arquivo</th>
        </tr>
    </thead>
    <tbody id="tbody">
      <?  
        $data = date('Y').'-'.date('m');
        $query = mysql_query("SELECT * FROM tb_pdf where SUBSTRING(`data`,1,7) = '$data'");
      
        while($ln = mysql_fetch_array($query)){ ?>
            <tr>
                <td align="left"><?= data2($ln['data']); ?></td>
                <td style="text-transform:uppercase;" align="left"><?= htmlentities($ln['nome']); ?></td>
                <td style="text-transform:uppercase;" align="left">
                    <a href="<?= $ln['arq_pdf']; ?>" target="_blank">Baixar</a>
                </td>
            </tr>

        <? } ?>
    </tbody>
</table>
</div>
