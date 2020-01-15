
<?php
    // define('HOST', '127.0.0.1');
    // define('USUARIO', 'admin');
    // define('SENHA','dascandangas');
    // define('DB','Sistema');
    // $conn = mysqli_connect(HOST,USUARIO,SENHA,DB) or die("Nao foi possivel conectar");
    $dsn = "mysql:dbname=CRUD;hostname=127.0.0.1";
    $dbuser = "admin";
    $dbpass = "dascandangas";

    try {
        $conn = new PDO($dsn,$dbuser,$dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE,pdo::ERRMODE_EXCEPTION);

    } catch (PDOexception $e) {
        echo "Error: ".$e->getMessage();
        //throw $th;
    }
?>
    
