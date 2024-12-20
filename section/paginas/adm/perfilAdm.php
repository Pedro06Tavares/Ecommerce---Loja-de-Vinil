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
        <?php

        if (empty($_SESSION['login'])) {
            echo "<a href=\"../geral/login.php\"><i class=\"fi fi-rs-heart\"></i></a>";
            echo "<a href=\"../geral/login.php\"><i class=\"fi fi-rr-shopping-cart-add\"></i></a>";
            echo "<a href=\"../geral/login.php\"><i class=\"fi fi-rs-user\"></i></a>";
            

        } else {
            echo "<a href=\"../usuario/listaDesejo.php\"><i class=\"fi fi-rs-heart\"></i></a>
            <a href=\"../usuario/carrinho.php\"><i class=\"fi fi-rr-shopping-cart-add\"></i></a>";
            if (!empty($_SESSION['email'])) {
                if ($_SESSION['email'] == "adm@adm.com") {
                    echo "<a href=\"../adm/perfilAdm.php\"><i class=\"fi fi-rs-user\"></i></a>";
                } else {
                    echo "<a href=\"../usuario/usuario.php\"><i class=\"fi fi-rs-user\"></i></a>";
                }
            }

        }

        ?>
        </div>
    </header>
    <main>
        <div id="bannerSlides">
            <img src="./section/imgs/bannersIniciais/porta.jpg" alt="banner1" class="bannerTop">
        </div>
        <section>
            
            </section>

        </section>
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
          <li><a href="../usuario/usuario.php">Minha Conta</a></li>
          <li><a href="../usuario/carrinho.php">Carrinho</a></li>
          <li><a href="../usuario/listaDesejo.php">Lista de Desejos</a></li>
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
          <li><a href="perfilAdm.html">Perfil Adiministrador</a></li>
          <li><a href="gerenciamentoTeste.php" >Gerenciamento</a></li>


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