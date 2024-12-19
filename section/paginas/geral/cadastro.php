<?php
            include('../../../config.php');
            $_SESSION['login'] = null;
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $usuario = $_POST['usuario'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
            }

            //Verificar se o e-ail já está cadastrado
            $sql = "SELECT * FROM cadastro WHERE email='$email'";
            $result = $conn->query($sql);

            if($result->num_rows>0){
                echo "<script>
                alert('E-mail já cadastrado. Tente outro.');
                window.location.href = 'cadastro.html';
              </script>";
            }
            else{
                $sql ="INSERT INTO cadastro (usuario,senha,email) VALUES ('$usuario','$senha','$email')";
                if($conn->query($sql) === TRUE){
                    echo "<script>
                    alert('Cadastro realizado com sucesso!');
                    window.location.href = 'login.php';
                  </script>";
                }
                else{
                    echo "<script> 
                    alert('Erro ao cadastrar: " . $conexao->error . "');
                    window.location.href = 'cadastro.html';
                  </script>";
                }
            }

            $conn->close();

            
        ?>