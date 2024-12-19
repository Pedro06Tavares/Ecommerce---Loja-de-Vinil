<?php
session_start();
$_SESSION['login'] = null;
include('../../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['email']) && !empty($_POST['senha'])) {


        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //Verificar se o e-mail já está cadastrado
        $sql = "SELECT * FROM cadastro WHERE email='$email'";
        $result = $conn->query($sql);
        $linha = mysqli_fetch_assoc($result);
        if ($result->num_rows === 1) {
            if ($senha === $linha["senha"]) {

                $_SESSION['usuario'] = $linha['usuario'];
                $_SESSION['email'] = $linha['email'];
                
                if ($linha['email'] === "adm@adm.com") {
                    $_SESSION['login'] = "logado";
                    header('location: ../adm/gerenciamentoTeste.php');
                } else {
                    $_SESSION['login'] = "logado";
                    header('location:../../../index.php');
                }

            } else {
                echo " <script>
                                alert(\"Senha Incorreta\");
                                </script>";

            }

        } else {
            echo " <script>
                    alert(\"usuario não Encontrado\");
                    </script>";

        }
    } else {

        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

$conn->close();
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
    <link rel="stylesheet" href="../../../style.css">
    <title>Login</title>
</head>

<body>
    <section id="topInfo">
        <div>
            <a href="">Até 70% de Desconto em Produtos Selecionados ></a>
        </div>
        <div>
            <a href="https://www.instagram.com/pedro_hrtavares/ " target="_blank"><i
                    class="fi fi-brands-instagram"></i></a>
            <a href="contato.html"><i class="fi fi-rr-envelope"></i></a>
            <a href=""><i class="fi fi-rr-universal-access"></i></a>
        </div>

    </section>

    <header>
        <div id="logoDiv">
            <a href="../../../index.html">
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
    <main id="mainLogin">
        <section class="loginCadastro">
            <h1 class="tituloLogin">Logar</h1>
            <p>Se você já tem seu cadastro na loja, informe nos campos abaixo seu email e sua senha de acesso à loja.
            </p>
            <form action="#" method="POST" id="formLogin">
                <label for="">E-mail: </label>
                <input type="text" name="email" id="" placeholder="Digite seu E-mail" required>
                <label for="">Senha: </label>
                <input type="password" name="senha" id="" placeholder="Digite sua Senha" required>
                <div class="logarEsenha">
                    <input type="submit" value="Logar">
                    <a href="../../imgs/outras/fodasse.jpg">Esqueceu sua Senha?</a>
                </div>

            </form>
            <p style="width: 100%; text-align: center;">Não possui uma conta? <a href="./cadastro.html">Cadastre-se</a>
                agora!</p>

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
                    <li><a href="login.php">Login</a></li>
                    <li><a href="cadastro.html">Cadastro</a></li>
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