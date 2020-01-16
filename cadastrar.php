<?php
    session_start();
    require_once 'conf.php';


    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        /*$nome = stripslashes($_POST['nome']);
        $email = stripslashes($_POST['email']);*/
        //$senha = md5(stripslashes($_POST['senha']));


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

        $query = $conn->prepare("INSERT INTO usuarios(nome,email,senha) VALUES(:nome,:email,:senha)");
        $query->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        ]);
        $_SESSION['status'] = true;
        # code...
        header("Location: cadastro.php");
        exit();
    }

?>
