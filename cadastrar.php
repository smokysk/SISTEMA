<?php
    session_start();
    require_once 'conf.php';


    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED));
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRIPPED);
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));

        /* Se o email for falso redireciona 
        *  Necessário mostrar uma mensagem para o usuário depois...
        */
        if(!$email){
            header('Location: index.php');
            exit();
        }

        $senha = password_hash($senha, PASSWORD_DEFAULT);

        //verifica se email ja exist
        $sql = $conn->prepare("SELECT * FROM usuarios WHERE email = :email ");
        $sql->bindValue("email",$email);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            echo "entrou";
            $dado = $sql->fetch();
            if($dado == 1){
            header("Location: cadastro.php");
            }
            $_SESSION['exists'] = true;
            header("Location: cadastro.php");
            # code...
            exit();
        }

        $query = $conn->prepare("INSERT INTO usuarios(nome,email,senha) VALUES(:nome,:email,:senha)");
        $query->bindValue("nome",$nome);
        $query->bindValue("email",$email);
        $query->bindValue("senha",$senha);
        $query->execute();
        $_SESSION['status'] = true;
        # code...
        header("Location: cadastro.php");
        exit();
    }

?>
