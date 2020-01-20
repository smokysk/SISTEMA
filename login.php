<?php


    session_start();
    require 'conf.php';

    if(empty($_POST['nome']) || empty($_POST['senha'])){
        header('Location: index.php');
        exit();
    }
    
    /* Dados Tratados */
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRIPPED);

    
    /* Busca no Banco */

    $query = $conn->prepare("SELECT * FROM usuarios WHERE nome = :nome");
    $query->bindValue("nome", $nome);
    $query->execute();


    if ($query->rowCount() > 0) {      
        $dado = $query->fetch(); 
        if(password_verify($senha, $dado['senha'])){
            $_SESSION['id'] = $dado['id'];
            $_SESSION['nome'] = $nome;

            header("Location: painel.php");
            exit();
  
        }else{
            header('Location: index.php');
            exit();
      
         }
  
    } else {
        header('Location: index.php');
        $_SESSION['noAuth'] = true;
        exit();

    }



    /* Codigo Legado */
   /*if(empty($_POST['nome']) || empty($_POST['senha'])){
        header('Location: index.php');
    }


         

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

 
        $query = $conn->prepare("SELECT * FROM usuarios WHERE nome = :nome");
        $query->execute([
            ':nome' => $nome
        ]);


   
 
        if ($query->rowCount() > 0) {
            $dado = $query->fetch(); 
                
            if(password_verify($senha, $dado['senha'])){
                $_SESSION['id'] = $dado['id'];
                $_SESSION['nome'] = $nome;

                header("Location: painel.php");
                exit();
            }else{
                header('Location: index.php');
                exit();
             }
      
        } else {
             header('Location: index.php');
            exit();

        }

    } */
