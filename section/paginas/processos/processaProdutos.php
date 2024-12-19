<?php

function embaralhaIds(){
    $produtos = listarProdutos(); //pega todos os produtos do banco de dados pela função do crud

        if($produtos->num_rows > 0){
            $idsProdutos = []; //array para mostrar depois
            while($produto = $produtos->fetch_assoc()){
                array_push( $idsProdutos,$produto['id']); //coloca os ids na array
                          
             }
        shuffle($idsProdutos); //embaralha os ids
       return $idsProdutos;

       }

       else{
          return null;
        }                

                        
}


function calculaDesconto($precoNormal, $desconto){
    $porcentagem = $desconto/$precoNormal;
    return number_format($porcentagem*100, 0, '.', '');
}

function calculaValorAtual($precoNormal, $desconto){
    return number_format($precoNormal - $desconto, 2, '.', '');
}

?>