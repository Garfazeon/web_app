<?php

    $server = "127.0.0.1";
    $username = "root";
    $password = "123";
    $dbName= "first";

    $link = mysqli_connect($server, $username, $password);
    if(!$link){
        die("Error connect: ". mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
    if(!mysqli_query($link,$sql)) {
        echo "Error create DB";
    }

    mysqli_close($link);

    $link = mysqli_connect($server, $username, $password, $dbName);
    
    $sql = "CREATE TABLE IF NOT EXISTS users(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        pass VARCHAR(50) NOT NULL
    )";

    if(!mysqli_query($link, $sql)){
        echo "Error create table users";
    } 

    $sql = "CREATE TABLE IF NOT EXISTS posts(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(20) NOT NULL,
        main_text VARCHAR(400) NOT NULL
    )";

    if(!mysqli_query($link, $sql)){
        echo "Error create table posts";
    } 

    mysqli_close($link);

?>