<?php
    session_start();
    require_once 'conf.php';

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = stripslashes($_POST['nome']);
        $senha = stripslashes($_POST['senha']);
        $query = $conn->prepare("SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha");
        $query->execute([
            'nome' => $nome,
            'senha' => $senha
        ]);
        
        if ($query->rowCount() > 0) {
            $dado = $query->fetch();

            $_SESSION['id'] = $dado['id'];
            $_SESSION['nome'] = $nome;
            # code...
            header("Location: painel.php");
        }

    } else {
        $_SESSION['noAuth'] = true;
        header("Location: painel.php");
        exit();
    }
    

  
?>