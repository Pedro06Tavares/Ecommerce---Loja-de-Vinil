<?php
session_start(); // Inicia a sessão

include '../../../config.php';
include '../processos/processaCarrinho.php';

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
    <link rel="stylesheet" href="../../../style.css">

    <title>Home</title>
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
            <a href="../usuario/listaDesejo.html"><i class="fi fi-rs-heart"></i></a>
            <a href="../usuario/carrinho.html"><i class="fi fi-rr-shopping-cart-add"></i></a>
            <a href="../usuario/usuario.html"><i class="fi fi-rs-user"></i></a>
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
            
            $produtos = listarCarrinho();
                if ($produtos->num_rows > 0) {
                    while ($produto = $produtos->fetch_assoc()) {
                        $valorFinal = $produto['preco'] - $produto['desconto'];
                        echo "<tr>
                                <td><img src='../../imgs/produtos/{$produto['imagem']}' alt='Imagem do produto' />
                                </td>
                                <td>{$produto['nome']}</td>
                                <td>R$ {$valorFinal}</td>
                                <td><form action><input value='{$produto['quantidadeProduto']}' type='number'></form></td>
                                
                                <td>
                                    <a href='?adicionar_carrinho={$produto['id']}&quantidade=1'>Adicionar ao Carrinho</a>
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
            &copy; <p>Todos os direitos reservados a Pedro Tavares Co.</p> <p>2024</p>
        </section>
        
    </footer>
</body>

</html>