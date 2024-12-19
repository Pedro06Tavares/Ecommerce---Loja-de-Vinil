<?php
function incluirProdutos($nome, $preco,$desconto, $quantidade, $imagem)
{
  global $conn;
  $sql = "SELECT * FROM produtos WHERE nome='$nome'";
  $result = $conn->query($sql);
  if($result->num_rows===0){
    if ($imagem['error'] == 0) {
      $imagemNome = uniqid() . '-' . $imagem['name'];
      move_uploaded_file($imagem['tmp_name'], '../../imgs/produtos/'.$imagemNome);
    } else {
      $imagemNome = ''; // Caso não tenha imagem
    }
    $sql = "INSERT INTO produtos (nome, preco,desconto, quantidade, imagem) 
              VALUES ('$nome', '$preco','$desconto', '$quantidade', '$imagemNome')";
  
    if ($conn->query($sql) === TRUE) {
      return ["status" => "success", "message" => "Produto incluído com sucesso!"];
    } else {
      return ["status" => "error", "message" => "Erro ao incluir produto: " . $conn->error];
    }
  }

  else{
    return ["status" => "error","message" => "Produto já cadastrado"];
  }
  
}

function listarProdutos()
{
  global $conn;

  $sql = "SELECT * FROM produtos";
  $result = $conn->query($sql);
  return $result;
}

function editarProdutos($id, $nome, $preco,$desconto,$quantidade, $imagem)
{
  global $conn;

    if ($imagem['error'] == 0) {
      $imagemNome = uniqid() . '-' . $imagem['name'];
      move_uploaded_file($imagem['tmp_name'], '../../imgs/produtos/'. $imagemNome);
      $sql = "UPDATE produtos SET nome = '$nome', preco = '$preco', desconto = '$desconto',quantidade = '$quantidade', imagem = '$imagemNome' WHERE id = '$id'";
    } else if ($imagem['error'] == 4) {
      $sql = "UPDATE produtos SET nome = '$nome', preco = '$preco',desconto = '$desconto', quantidade = '$quantidade' WHERE id = '$id'";
    }
 

  if ($conn->query($sql) === TRUE) {
    return ["status" => "success", "message" => "Produto editado com sucesso!"];
  } else {
    return ["status" => "error", "message" => "Erro ao editar produto: " . $conn->error];
  }
}

function excluirProdutos($id)
{
  global $conn;
  $sql = "SELECT * FROM produtos WHERE id='$id'";
  $result= $conn->query($sql);
  $produto = mysqli_fetch_assoc($result);
  unlink("../../imgs/produtos/{$produto['imagem']}");
  $sql = "DELETE FROM produtos WHERE id = $id";
  

  if ($conn->query($sql) === TRUE) {
    return ["status" => "success", "message" => "Produto excluído com sucesso!"];
  } else {
    return ["status" => "error", "message" => "Erro ao excluir produto: " . $conn->error];
  }
}
