<?php
function adcCarrinho($id){
    global $conn;
    $qntd = 1;
    $identificador = $id;

    //bolar um jeito de saber se o produto já foi adicionado no carrinho

    $sql = "INSERT INTO carrinho (id,quantidadeProduto ) 
              VALUES ($identificador, $qntd)";


        if($conn->query($sql) === TRUE){
            $sql = "SELECT * FROM produtos WHERE id='$identificador'";
            $result = $conn->query($sql);
            $produto = mysqli_fetch_assoc($result);
            $quantidade= $produto['quantidade'] - $qntd;
            $sql = "UPDATE produtos SET quantidade = '$quantidade' WHERE id = '$id'";
            if($conn->query($sql) === TRUE){
                return 1;
            }
            
        }

        else{
            
            return 0;
        }
       
    
}

function listarCarrinho()
{

  global $conn;
  $sql = "SELECT carrinho.*,produtos.* FROM produtos,carrinho WHERE carrinho.id = produtos.id";
  $result = $conn->query($sql);
  return $result;
}


function mudaQntd($id, $qntd){
    global $conn;
    $sql = "UPDATE carrinho SET quantidadeProduto = '$qntd' WHERE id = '$id'";
    if($conn->query($sql) === TRUE){
        return 1;
    }

    else{
        return 0;
    }

    //criar um esquema que ao mudar a quantidade eu posso ver a quantidade antiga e subtrairr apenoas nova quantidade acrescentada do produtos
}

function retiraCarrinho($id){
    global $conn;
    $sql = "DELETE FROM carrinho WHERE id = $id";
    if($conn->query($sql) === TRUE){
        return 1;
    }

    else{
        return 0;
    }

    // repor a quantidade reservada 
}
?>