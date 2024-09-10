<?php

class Database
{
    public function query($query, $param = [])
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "datn";


        $dsn = "mysql:host=$servername;port=3306;dbname=$dbname;user=$username;password=$password";
        $pdo = new PDO($dsn);

        $statement = $pdo->prepare($query);
        $statement->execute($param);

       return $statement;
    }
}

