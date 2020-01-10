<?php
    session_start();
    require_once 'conf.php';

    if (empty($_POST['nome']) && empty($_POST['nome_usuario']) && empty($_POST['email']) && empty($_POST['senha'])) {
        header("Location: cadastro.php");
        # code...
        exit();
    }

    $nome = mysqli_real_escape_string($conn, ($_POST['nome']));
    $nome_usuario = mysqli_real_escape_string($conn, ($_POST['nome_usuario']));
    $email = mysqli_real_escape_string($conn, ($_POST['email']));
    $senha = mysqli_real_escape_string($conn, md5($_POST['senha']));


    $sql = "SELECT count(*) as total from usuarios where email = '$email'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    if (row['total'] != 0) {
        $_SESSION['userExists'] = true;
        header('Location: cadastro.php');
        exit();
        # code...
    }
    $sql =  "INSERT INTO usuarios(nome,nome_usuario,email,senha,data_criado) VALUES('$nome','$nome_usuario','$email', '$senha', 'NOW()')";

    if ($conn->query($sql) === true ) {
        echo "cadastro feito com sucesso";
        $_SESSION['status'] = true;
        exit();
    }
    else {
        echo "cadastro error";
    }
    $conn->close();
    header('Location: cadastro.php');
    exit();
?>
