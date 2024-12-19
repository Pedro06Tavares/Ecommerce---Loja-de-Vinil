<?php
include 'config.php';
include 'section/paginas/processos/processaProdutos.php';
include 'section/paginas/processos/processaCarrinho.php';
include 'section/paginas/adm/crud.php';


session_start();

global $conn;

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array(); // Cria um carrinho vazio
}

if (!empty($_GET['adicionar_carrinho'])) {
    $id = $_GET['adicionar_carrinho'];
    $id=intval($id); //converte a string de numero em um int, força o id a ser um inteiro para não dar problemas de sintaxe no sql
    adcCarrinho($id);
    header("Location: ./section/paginas/usuario/carrinho.php");
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
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./section/imgs/logo/logoLoja.jpg">
    <title>Home</title>
</head>

<body>
    <section id="topInfo">
        <div>
            <a href="">Até 70% de Desconto em Produtos Selecionados ></a>
        </div>
        <div>
            <a href="https://www.instagram.com/pedro_hrtavares/ " target="_blank"><i
                    class="fi fi-brands-instagram"></i></a>
            <a href="./section/paginas/geral/contato.html"><i class="fi fi-rr-envelope"></i></a>
            <a href=""><i class="fi fi-rr-universal-access"></i></a>
        </div>

    </section>

    <header>
        <div id="logoDiv">
            <a href="index.html">
                <img src="./section/imgs/logo/logoLoja.jpg" alt="" id="logoIcon">
            </a>
        </div>

        <form action="./section/imgs/albuns/20th.jpg" id="campoPesquisa">
            <input type="text" placeholder="O que você está procurando?">
            <button type="submit"><i class="fi fi-br-search"></i></button>
        </form>

        <div id="linksRapidos">
            <a href="./section/paginas/usuario/listaDesejo.html"><i class="fi fi-rs-heart"></i></a>
            <a href="./section/paginas/usuario/carrinho.html"><i class="fi fi-rr-shopping-cart-add"></i></a>
            <?php

            if (empty($_SESSION['login'])) {
                echo "<a href=\"./section/paginas/geral/login.php\"><i class=\"fi fi-rs-user\"></i></a>";

            } else {
                if (!empty($_SESSION['email'])) {
                    if ($_SESSION['email'] == "adm@adm.com") {
                        echo "<a href=\"./section/paginas/adm/perfilAdm.html\"><i class=\"fi fi-rs-user\"></i></a>";
                    } else {
                        echo "<a href=\"./section/paginas/usuario/usuario.html\"><i class=\"fi fi-rs-user\"></i></a>";
                    }
                }

            }

            ?>

            </di>
    </header>
    <main>
        <div id="bannerSlides">
            <img src="./section/imgs/bannersIniciais/porta.jpg" alt="banner1" class="bannerTop">
        </div>
        <section>
            <nav class="linkPrincipais">
                <a href="" class="principaisNav-item">
                    <h2>Visto recentemente</h2>
                    <img src="./section/imgs/albuns/dificil-chao-de-taco.jpg" alt="Vinil Difícil da Chão de Taco"
                        class="vinilTamanho mudaTmnImg">
                    <div class="infosPrincNav">
                        <p>Dificíl - Chão de Taco</p>
                        <h2>R$ 100,00</h2>
                    </div>
                </a>

                <a href="" class="principaisNav-item">
                    <h2>Sugerido</h2>
                    <img src="./section/imgs/albuns/bella.jpg" alt="Vinil Bella e O Olmo da Bruxa"
                        class="vinilTamanho mudaTmnImg">
                    <div class="infosPrincNav">
                        <p>Autoentitulado - Bella e o Olmo da Bruxa</p>
                        <h2>R$ 120,00</h2>
                    </div>
                </a>

                <a href="" class="principaisNav-item">
                    <h2>Ofertas</h2>
                    <i class="fi fi-ss-badge-percent"></i>
                    <form action=""><button type="submit" class="buttonTipo1 mudaTmnImg">Conferir</button></form>

                </a>

                <a href="" class="principaisNav-item">
                    <h2>Catálogo</h2>
                    <i class="fi fi-ss-disc-drive"></i>
                    <form action=""><button type="submit" class="buttonTipo1 mudaTmnImg">Acessar</button></form>
                </a>
                <?php
                if (empty($_SESSION['login'])) {
                    echo "<a href=\"./section/paginas/geral/cadastro.html\" class=\"principaisNav-item\">
                    <h2>Sem Cadastro?</h2>
                    <i class=\"fi fi-ss-user\"></i>
                    <form action=\"\"><button type=\"submit\" class=\"buttonTipo1 mudaTmnImg\">Cadastrar</button></form>
                </a>";
                }
                ?>
            </nav>

            <section class="containerProdutosDestaques">
                <div>
                    <h1>Ofertas em Nacional</h1>
                </div>
                <div class="listaProdutosDestaque">
                    <?php

                        $idsProdutos = embaralhaIds();

                        if($idsProdutos === null){
                            echo "não há produtos";
                        }

                        else{
                            for($i=0;$i<6;$i++){
                                $sql="SELECT * FROM produtos WHERE id='{$idsProdutos[$i]}'";
                                $result= $conn->query($sql);
                                $produto = mysqli_fetch_assoc($result);
                                $valorAtual = calculaValorAtual($produto['preco'], $produto['desconto']);
                                $procentagemDesconto = calculaDesconto($produto['preco'], $produto['desconto']);
                                echo "<div class=\"produtosDestaques\">
                                        <a href=\"\">
                                            <img src=\"./section/imgs/produtos/{$produto['imagem']}\" alt=\"Vinil\"class=\"vinilTamanho mudaTmnImg\">
                                        </a>";
                                        if($produto['desconto']>0){
                                            echo "<div class=\"promocaoProdutosDestaques\">
                                            <h5 class=\"numPromo\">{$procentagemDesconto}% off</h5>
                                            <p>Oferta em Nacional</p>
                                        </div>";
                                        }

                                        echo"<div class=\"infosPrincNav\">
                                        <a href=\"\">{$produto['nome']}</a>
                                        <div class=\"quedaPrecos\">
                                        <h2>R$ {$valorAtual}</h2>";
                                        if($produto['desconto']>0){
                                            echo "<h4>R$ {$produto['preco']}</h4>";
                                        }

                                        echo "</div>
                                        <div class=\"favCarrinho\">
                                            <a href=\"./section/paginas/usuario/listaDesejo.html\"><i class=\"fi fi-rs-heart\"></i></a>
                                            <a href=\"?adicionar_carrinho={$produto['id']}'\"><i
                                                    class=\"fi fi-rr-shopping-cart-add\"></i></a>
                                        </div>
                                    </div>
                                </div>";
                            if($i<sizeof($idsProdutos)-1 && sizeof($idsProdutos) > 1 ){
                                echo "<div class=\"barraDivisaProdutosDestaque\"></div>"; // barrinha azul daora
                            }
                            }

                            $valorAtual =0;
                        }
                    ?>
                </div>
            </section>

            <section id="melhroAvaliados">
                <div id="nomeListaPordutosGerais">
                    <h1>Melhor Avaliados</h1>
                    <i class="fi fi-ss-star"></i>
                </div>

                <div class="produtosGerais">
                    <?php

                        $idsProdutos = embaralhaIds();

                        if($idsProdutos === null){
                            echo "não há produtos";
                        }

                        else{
                            for($i=0;$i<sizeof($idsProdutos);$i++){
                                $sql="SELECT * FROM produtos WHERE id='{$idsProdutos[$i]}'";
                                $result= $conn->query($sql);
                                $produto = mysqli_fetch_assoc($result);
                                $valorAtual = calculaValorAtual($produto['preco'], $produto['desconto']);
                                $procentagemDesconto = calculaDesconto($produto['preco'], $produto['desconto']);
                                echo "<div class=\"produtosDestaques\">
                                        <a href=\"\">
                                            <img src=\"./section/imgs/produtos/{$produto['imagem']}\" alt=\"Vinil\"class=\"vinilTamanho mudaTmnImg\">
                                        </a>";
                                        if($produto['desconto']>0){
                                            echo "<div class=\"promocaoProdutosDestaques\">
                                            <h5 class=\"numPromo\">{$procentagemDesconto}% off</h5>
                                            <p>Oferta em Nacional</p>
                                        </div>";
                                        }

                                        echo"<div class=\"infosPrincNav\">
                                        <a href=\"\">{$produto['nome']}</a>
                                        <div class=\"quedaPrecos\">
                                        <h2>R$ {$valorAtual}</h2>";
                                        if($produto['desconto']>0){
                                            echo "<h4>R$ {$produto['preco']}</h4>";
                                        }

                                        echo "</div>
                                        <div class=\"favCarrinho\">
                                            <a href=\"./section/paginas/usuario/listaDesejo.html\"><i class=\"fi fi-rs-heart\"></i></a>
                                            <a href=\"./section/paginas/usuario/carrinho.html\"><i
                                                    class=\"fi fi-rr-shopping-cart-add\"></i></a>
                                        </div>
                                    </div>
                                </div>";
                            if($i<sizeof($idsProdutos)-1 && sizeof($idsProdutos) > 1 ){
                                echo "<div class=\"barraDivisaProdutosDestaque\"></div>";
                            }
                            }

                            $valorAtual =0;
                        }
                    ?>
                </div>
            </section>

        </section>
    </main>
    <footer>
        <section>
            <div>
                <h3>Institucional</h3>
                <ul>
                    <li><a href="./section/paginas/geral/sobre.html">Sobre</a></li>
                    <li><a href="">Termos de Uso</a></li>
                    <li><a href="">Devolução e Reembolso</a></li>
                    <li><a href="">Políticas de Segurança</a></li>
                </ul>
            </div>
            <div>
                <h3>Usuário</h3>
                <ul>
                    <li><a href="./section/paginas/usuario/usuario.html">Minha Conta</a></li>
                    <li><a href="./section/paginas/usuario/carrinho.html">Carrinho</a></li>
                    <li><a href="./section/paginas/usuario/listaDesejo.html">Lista de Desejos</a></li>
                    <li><a href="./section/paginas/geral/login.php">Login</a></li>
                    <li><a href="./section/paginas/geral/cadastro.html">Cadastro</a></li>

                </ul>
            </div>
            <div>
                <h3>Contato</h3>
                <ul>
                    <li><a href="./section/paginas/geral/contato.html">Fale Conosco</a></li>
                    <li>+55 (35) 9 9744-3243 (Celular)</li>
                    <li>9 9738-0422 (Fixo)</li>
                    <li>9 9760-6089 (Fixo 2)</li>
                    <li>pedrohrtavares06@gmail.com</li>

                </ul>
            </div>
            <?php
            if (isset($_SESSION["email"]) && $_SESSION['email'] == "adm@adm.com") {
                echo "<div>
                    <h3>Adiministrador</h3>
                    <ul>
                        <li><a href=\"./section/paginas/adm/perfilAdm.html\" >Perfil Adiministrador</a></li>
                        <li><a href=\"./section/paginas/adm/gerenciamentoTeste.php\">Gerenciamento</a></li>
                        

                    </ul>
                </div>";
            }

            ?>

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