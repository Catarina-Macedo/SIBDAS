<?php

session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
    header('Location: Homepage.php');
}

$id_exec = $_GET['id_exec'];
$id_cliente = $_GET['id_cliente'];


if (empty($id_exec) && empty($id_cliente)) {
    header('Location: Homepage.php');
}

if (empty($id_exec)) {
    header('Location: client_info.php?id_cliente=' . $id_cliente);
}

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);


try {
    $ligacao->exec("DELETE FROM execucao WHERE id = '$id_exec'");
    header('Location: client_info.php?id_cliente=' . $id_cliente);
} catch (PDOException $err) {
    echo $err;
}

$ligacao = null;

?>