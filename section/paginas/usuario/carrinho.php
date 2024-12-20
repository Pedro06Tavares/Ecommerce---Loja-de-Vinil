<?php
session_start(); // Inicia a sessão
global $conn;
include '../../../config.php';
include '../processos/processaCarrinho.php';
include '../processos/processaProdutos.php';
if(isset($_GET['qntd'])){
    $quantidade=$_GET['qntd'];
    $id = $_GET['id-produto'];
    mudaQntd($id,$quantidade);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Verificar se foi pedido para excluir um produto
if (isset($_GET['retirar-produto'])) {
    $id = $_GET['retirar-produto'];
    retiraCarrinho($id);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  }

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-brands/css/uicons-brands.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel="stylesheet" href="../../../style.css">

    <title>Carrinho</title>
</head>

<body>
    
    <header>
        <div id="logoDiv">
            <a href="../../../index.php" >
                <img src="../../imgs/logo/logoLoja.jpg" alt="" id="logoIcon">
            </a>
            
        </div>

        <div  id="campoPesquisa">
            <input type="text" placeholder="O que você está procurando?">
            <button type="submit"><i class="fi fi-br-search"></i></button>
        </div>

        <div id="linksRapidos">
        <?php

            if (empty($_SESSION['login'])) {
                echo "<a href=\"../geral/login.php\"><i class=\"fi fi-rs-heart\"></i></a>";
                echo "<a href=\"../geral/login.php\"><i class=\"fi fi-rr-shopping-cart-add\"></i></a>";
                echo "<a href=\"../geral/login.php\"><i class=\"fi fi-rs-user\"></i></a>";
                

            } else {
                echo "<a href=\"listaDesejo.php\"><i class=\"fi fi-rs-heart\"></i></a>
                <a href=\"carrinho.php\"><i class=\"fi fi-rr-shopping-cart-add\"></i></a>";
                if (!empty($_SESSION['email'])) {
                    if ($_SESSION['email'] == "adm@adm.com") {
                        echo "<a href=\"../adm/perfilAdm.php\"><i class=\"fi fi-rs-user\"></i></a>";
                    } else {
                        echo "<a href=\"usuario.php\"><i class=\"fi fi-rs-user\"></i></a>";
                    }
                }

            }

            ?>
        </div>
    </header>
    <main>
        <div id="bannerSlides">
            <img src="../../imgs/bannersIniciais/porta.jpg" alt="banner1" class="bannerTop">
        </div>
        <section>
        <table >
            <thead>
                <tr>
                    <th colspan='2'>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade Produto</th>
                    
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
           <!-- Tabela de exibição dos produtos -->
            <?php
            // Dentro da exibição da lista de produtos
            $valorCompra = 0;
            $produtos = listarCarrinho();
                if ($produtos->num_rows > 0) {
                    while ($produto = $produtos->fetch_assoc()) {
                        $valorFinal = calculaValorAtual($produto['preco'],$produto['desconto']);
                        
                        $valorCompra =$valorCompra+($valorFinal*$produto['quantidadeProduto']);
                        echo "<tr>
                                <td><img src='../../imgs/produtos/{$produto['imagem']}' alt='Imagem do produto' />
                                </td>
                                <td>{$produto['nome']}</td>
                                <td>R$ {$valorFinal}</td>
                                <td><form action='{$_SERVER["PHP_SELF"]}' method='GET'>
                                    <input value='{$produto['id']}' type='hidden'  name='id-produto' id='id-produto'>   
                                    <input value='{$produto['quantidadeProduto']}' type='number'  name='qntd' id='qntd' min='1'>
                                </form></td>
                                
                                <td>
                                    <a href='?retirar-produto={$produto['id']}'><i class=\"fi fi-rs-trash\"></i></a>
                                </td>
                            </tr>";
                    }
                } 
                else {
                    echo "<tr><td colspan='8'>Nenhum produto No Carrinho.</td></tr>";
                }
        ?>
            
        </tbody>
        </table>

        <div class="finalCarrinho">
            <div>
                <h4>Digite o CEP</h4>
                <form action="#">
                    <input type="text" name="cep" id="cep" placeholder="Ex.:37713308">
                </form>
            </div>
            <div >
                <h4>Total: </h4>
                <?php
                    echo "<h1>".number_format($valorCompra, 2, '.', '')."</h1>";
                ?>
            </div>
        </div>

        <div class="finalizar">
            <a href="../../../index.php">Ver Mais Produtos</a>
            <a href="">Finalizar</a>
        </div>

        </section>
    </main>
    <footer>
        <section>
            <div>
                <h3>Institucional</h3>
                <ul>
                    <li><a href="../geral/sobre.html">Sobre</a></li>
                    <li><a href="">Termos de Uso</a></li>
                    <li><a href="">Devolução e Reembolso</a></li>
                    <li><a href="">Políticas de Segurança</a></li>
                </ul>
            </div>
            <div>
                <h3>Usuário</h3>
                <ul>
                    <li><a href="usuario.php">Minha Conta</a></li>
                <li><a href="carrinho.php">Carrinho</a></li>
                <li><a href="listaDesejo.php">Lista de Desejos</a></li>
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
                    <li><a href="../adm/perfilAdm.php">Perfil Adiministrador</a></li>
                    <li><a href="../adm/gerenciamentoTeste.php" >Gerenciamento</a></li>
                    

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
            &copy; <p>Todos os direitos reservados a Pedro Tavares Co.</p> <p>2024</p>
        </section>
        
    </footer>
</body>

</html>