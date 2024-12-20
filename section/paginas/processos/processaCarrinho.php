<?php


/*
function adicionarAoCarrinho($id, $nome, $preco, $quantidade = 1) {
    // Se o produto já estiver no carrinho, incrementa a quantidade
    foreach ($_SESSION['carrinho'] as $key => $produto) {
        if ($produto['id'] == $id) {
            $_SESSION['carrinho'][$key]['quantidade'] += $quantidade;
            return;
        }
    }
    
    // Caso o produto não esteja no carrinho, adiciona um novo item
    $novoProduto = [
        'id' => $id,
        'nome' => $nome,
        'preco' => $preco,
        'quantidade' => $quantidade
    ];
    
    $_SESSION['carrinho'][] = $novoProduto;
    header('location:./section/paginas/usuario/carrinho.php');
    exit();
}
*/

function adcCarrinho($id){
    global $conn;
    $qntd = 1;
    $identificador = $id;
   // $sql = "INSERT INTO carrinho (id,quantidadeProduto) VALUES ('$id','$qntd')";
    $sql = "INSERT INTO carrinho (id,quantidadeProduto ) 
              VALUES ($identificador, $qntd)";
    if($conn->query($sql) === TRUE){
        return 1;
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
}
?>