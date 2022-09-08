<?php
    //conexão com o banco de dados
    $connection = new mysqli('localhost','root','','escritorio');

    if($connection->connect_error)
    {
        die('Connection Failed : '.$connection->connection_error);
    }

?>