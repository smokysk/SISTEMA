<?php
    session_start();
    require 'conf.php';
    if(empty($_POST['nome']) || empty($_POST['senha'])){
        header('Location: index.php');
    }

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = stripslashes($_POST['nome']);
        $senha = md5(stripslashes($_POST['senha']));
        
        $query = $conn->prepare("SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha");
        $query->execute([
            'nome' => $nome,
            'senha' => $senha
        ]);
        if ($query->rowCount() > 0) {
            $dado = $query->fetch(); 
            var_dump($dado);   
            $_SESSION['id'] = $dado['id'];
            $_SESSION['nome'] = $nome;
            header("Location: painel.php");
            exit();
        } else {
            header('Location: index.php');
            exit();
        }

    } 
?>