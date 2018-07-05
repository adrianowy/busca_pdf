/**
  * Fun��o para criar um objeto XMLHTTPRequest
  */
 function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
         
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
         
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request = false;
             }
         }
     }
     
     if (!request) 
         alert("Seu Navegador n�o suporta Ajax!");
     else
         return request;
 }
 
 /**
  * Fun��o para enviar os dados
  */
 function getDados() {
     
     //alert("chegou");
     
     // Declara��o de Vari�veis
     var buscar = document.getElementById("buscar").value;
     var ano    = document.getElementById("ano").value;
     var mes    = document.getElementById("mes").value;
     var result = document.getElementById("tbody");
     var xmlreq = CriaRequest();
     
     // Exibi a imagem de progresso
     result.innerHTML = 'Carregando...';
     
     // Iniciar uma requisi��o
     xmlreq.open("GET", "carregarLista.php?buscar="+buscar+"&ano="+ano+"&mes="+mes, true);
     
     // Atribui uma fun��o para ser executada sempre que houver uma mudan�a de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi conclu�do com sucesso e a conex�o fechada (readyState=4)
         if (xmlreq.readyState === 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status === 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }