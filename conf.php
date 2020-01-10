<?php
    define('HOST', '127.0.0.1');
    define('USUARIO', 'admin');
    define('SENHA','dascandangas');
    define('DB','Sistema');

    $conn = mysqli_connect(HOST,USUARIO,SENHA,DB) or die("Nao foi possivel conectar");

?>