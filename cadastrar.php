<?php
    session_start();
    require_once 'conf.php';


    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = stripslashes($_POST['nome']);
        $email = stripslashes($_POST['email']);
        $senha = md5(stripslashes($_POST['senha']));
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

    // $nome = mysqli_real_escape_string($conn, ($_POST['nome']));
    // $nome_usuario = mysqli_real_escape_string($conn, ($_POST['nome_usuario']));
    // $email = mysqli_real_escape_string($conn, ($_POST['email']));
    // $senha = mysqli_real_escape_string($conn, md5($_POST['senha']));


    // $sql = "SELECT count(*) as total from usuarios where email = '$email'";
    // $result = mysqli_query($conn,$sql);
    // $row = mysqli_fetch_assoc($result);

    // if (row['total'] != 0) {
    //     $_SESSION['userExists'] = true;
    //     header('Location: cadastro.php');
    //     exit();
    //     # code...
    // }
    // $sql =  "INSERT INTO usuarios(nome,nome_usuario,email,senha,data_criado) VALUES('$nome','$nome_usuario','$email', '$senha', 'NOW()')";

    // if ($conn->query($sql) === true ) {
    //     echo "cadastro feito com sucesso";
    //     $_SESSION['status'] = true;
    //     exit();
    // }
    // else {
    //     echo "cadastro error";
    // }
    // $conn->close();
    // header('Location: cadastro.php');
    // exit();
?>
