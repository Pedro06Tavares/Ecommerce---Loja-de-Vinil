<?php
include 'crud.php'; // Incluir as funções CRUD
include '../../../config.php';
include '../processos/processaProdutos.php';

$statusMessage = null;
session_start();
// Verificar se o formulário foi enviado para incluir ou editar produtos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = isset($_POST['id']) ? $_POST['id'] : null;
  $nome = $_POST['nome'];
  $preco = $_POST['preco'];
  $quantidade = $_POST['quantidade'];
  $imagem = $_FILES['imagem'];
  $desconto = $_POST['desconto'];

  if ($id) {
    // Editar produto
    $statusMessage = editarProdutos($id, $nome, $preco, $desconto,  $quantidade, $imagem);
  } else {
    // Incluir produto
    $statusMessage = incluirProdutos($nome, $preco, $desconto,$quantidade, $imagem);
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  //header ('location:../login.php');
  exit();
}

// Verificar se foi pedido para excluir um produto
if (isset($_GET['excluir'])) {
  $id = $_GET['excluir'];
  $statusMessage = excluirProdutos($id);
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro de Produtos</title>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
  <link rel='stylesheet'
    href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
  <link rel='stylesheet'
    href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel='stylesheet'
    href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-brands/css/uicons-brands.css'>
  <link rel='stylesheet'
    href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel="stylesheet" href="styleGerenciamento.css" />
  <link rel="icon" href="../../imgs/logo/logoBranca.jpg">
</head>

<body>

  <header>
    <div id="logoDiv">
      <a href="../../../index.php">
        <img src="../../imgs/logo/logoLoja.jpg" alt="" id="logoIcon">
      </a>

    </div>

    <div id="campoPesquisa">
      <input type="text" placeholder="O que você está procurando?">
      <button type="submit"><i class="fi fi-br-search"></i></button>
    </div>

    <div id="linksRapidos">
      <a href="../usuario/listaDesejo.html"><i class="fi fi-rs-heart"></i></a>
      <a href="../usuario/carrinho.html"><i class="fi fi-rr-shopping-cart-add"></i></a>
      <a href="../usuario/usuario.html"><i class="fi fi-rs-user"></i></a>
    </div>
  </header>
  <?php if ($statusMessage): ?>
    <script>
      alert("<?php echo $statusMessage['message']; ?>");
    </script>
  <?php endif; ?>

  <main>
    <div class="mask" id="mask"></div>
    <div class="overlay" id="overlay">
      <button class="close" onclick="closeForm()">
        <span class="material-symbols-outlined">close</span>
      </button>
      <div class="modal">
        <!-- Formulário para adicionar/editar produtos -->
        <form id="produtoForm" class="produtoForm" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>"
          enctype="multipart/form-data" onsubmit="return validarFormulario()">
          <input type="hidden" name="id" id="productId" />
          <label for="nome">Nome:</label>
          <input type="text" name="nome" id="nome" required />

          <label for="preco">Preço:</label>
          <input type="number" step="0.01" name="preco" id="preco" required />

          <label for="desconto">Desconto:</label>
          <input type="number" step="0.01" name="desconto" id="desconto" required />

          <label for="quantidade">Quantidade:</label>
          <input type="number" name="quantidade" id="quantidade" required />

          <label for="imagem">Imagem:</label>
          <input type="file" name="imagem" id="imagem" accept="image/*" />


          <button type="submit">Salvar</button>

        </form>
      </div>
    </div>

    <nav class="infoUser">
      <?php
      echo "<img src='../../imgs/users/download.jpg' alt='Imagem do produto' class=\"user-img\" />"
        ?>
      <div>
        <?php
        if (isset($_SESSION["usuario"])) {
          echo "<h1> Bem Vindo, " . $_SESSION["usuario"] . "</h1>";
        } else {
          echo "<h1>Bem Vindo Zé Niguém</h1>";
        }
        ?>
        <form method="GET" action="">
          <button class="logoff" name="logout">Sair</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
          if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            header('location:../geral/login.php');
          }
        }
        ?>
      </div>


    </nav>

    <div id="produtosCadastrados">
      <h1>Produtos Cadastrados</h1>
      <div class="novoProdutoQtnd">
        <!-- Botão para exibir o formulário -->
        <button class="btn-add" onclick="openForm()">Novo Produto</button>
        <h2>Quantidade de Produtos:
          <?php
          $sql = "SELECT * FROM produtos";
          $result = $conn->query($sql);
          echo $result->num_rows;
          ?>
        </h2>
      </div>


      <!-- Tabela de exibição dos produtos -->
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Desconto</th>
            <th>Preço Com Desconto</th>
            <th>Quantidade</th>
            <th>Imagem</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $produtos = listarProdutos();

          if ($produtos->num_rows > 0) {
            while ($produto = $produtos->fetch_assoc()) {
              $valorAtual = calculaValorAtual($produto['preco'], $produto['desconto']);
              echo "<tr>
                                      <td>{$produto['nome']}</td>
                                      <td>R$ {$produto['preco']}</td>
                                      <td>R$ {$produto['desconto']}</td>
                                      <td>R$ {$valorAtual}</td>
                                      <td>{$produto['quantidade']}</td>
                                      
                                      <td><img src='../../imgs/produtos/{$produto['imagem']}' alt='Imagem do produto' /></td>
                                      <td class='actions'>
                                          <a class='editar' onclick='editarProduto({$produto['id']}, \"{$produto['nome']}\", {$produto['preco']},{$produto['desconto']},{$produto['quantidade']}, \"{$produto['imagem']}\")'>Editar</a>
                                          <a class='excluir' href='?excluir={$produto['id']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                                      </td>
                                    </tr>";
            }
          } else {
            echo "<tr><td colspan='5'>Nenhum produto cadastrado.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <script>
      const mask = document.getElementById("mask");
      const overlay = document.getElementById("overlay");

      function openForm() {
        // Exibir o modal
        mask.style.display = "block";
        overlay.style.display = "flex";
      }

      function closeForm() {
        // Limpar os dados do formulário
        document.getElementById("produtoForm").reset();
        // Esconder o modal
        mask.style.display = "none";
        overlay.style.display = "none";
      }

      function editarProduto(id, nome, preco, desconto,quantidade, imagem) {
        document.getElementById("productId").value = id;
        document.getElementById("nome").value = nome;
        document.getElementById("preco").value = preco;
        document.getElementById("desconto").value = desconto;
        document.getElementById("quantidade").value = quantidade;
        // Limpa o campo de imagem
        document.getElementById("imagem").value = '';
        openForm();
      }
    </script>
  </main>
  <footer>
    <section>
      <div>
        <h3>Institucional</h3>
        <ul>
          <li><a href="./section/paginas/sobre.html">Sobre</a></li>
          <li><a href="">Termos de Uso</a></li>
          <li><a href="">Devolução e Reembolso</a></li>
          <li><a href="">Políticas de Segurança</a></li>
        </ul>
      </div>
      <div>
        <h3>Usuário</h3>
        <ul>
          <li><a href="../usuario/usuario.html">Minha Conta</a></li>
          <li><a href="../usuario/carrinho.html">Carrinho</a></li>
          <li><a href="../usuario/listaDesejo.html">Lista de Desejos</a></li>
          <li><a href="../geral/login.php">Login</a></li>
          <li><a href="../geral/cadastro.html">Cadastro</a></li>
          <li><a href="../../../config.php">Config</a></li>

        </ul>
      </div>
      <div>
        <h3>Contato</h3>
        <ul>
          <li><a href="../geral/contato.html">Fale Conosco</a></li>
          <li>+55 (35) 9 9744-3243 (Celular)</li>
          <li>9 9738-0422 (Fixo)</li>
          <li>9 9760-6089 (Fixo 2)</li>
          <li>pedrohrtavares06@gmail.com</li>

        </ul>
      </div>
      <div>
        <h3>Adiministrador</h3>
        <ul>
          <li><a href="perfilAdm.html" target="_blank">Perfil Adiministrador</a></li>
          <li><a href="gerenciamentoTeste.php" target="_blank">Gerenciamento</a></li>


        </ul>
      </div>
      <div>
        <h3>Redes Sociais</h3>
        <ul>
          <li><a href="https://www.instagram.com/pedro_hrtavares/ " target="_blank">Instagram</a></li>
          <li><a href="" target="_blank">Facebook</a></li>
          <li><a href="https://x.com/i/bookmarks?post_id=1821894600019378531" target="_blank">X</a></li>

        </ul>
      </div>
    </section>
    <section id="direitos">
      &copy; <p>Todos os direitos reservados a Pedro Tavares Co.</p>
      <p>2024</p>
    </section>

  </footer>
</body>

</html>