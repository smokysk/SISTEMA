<?php
    session_start();
    require_once 'conf.php';

    if (empty($_POST['nome']) && empty($_POST['senha'])) {
        header("Location: index.php");
        # code...
        exit();
    }

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $senha = md5(mysqli_real_escape_string($conn, $_POST['senha']));

    $query = "SELECT * from usuarios where nome = '{$nome}' and senha = '{$senha}'";

    $result = mysqli_query($conn, $query);

    $row = mysqli_num_rows($result);

    if ($row == 1) {
        $_SESSION['nome'] = $nome;
        header('Location: painel.php');
        exit();
    } else {
        $_SESSION['noAuth'] = true;

        header('Location: index.php');
        exit(); 
    }
?>