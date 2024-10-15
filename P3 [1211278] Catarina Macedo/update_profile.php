<?php
session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
  header('Location: Homepage.php');
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: perfil.php');
}

$id = $_SESSION['user'];
$nome = $_POST['name'];
$email = $_POST['email'];
$morada = $_POST['address'];
$tele = $_POST['phone'];

$parametros = [
  ':id' => $id,
  ':nome' => $nome,
  ':morada' => $morada,
  ':email' => $email,
  ':telefone' => $tele
];

try {
  $ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
  $comando = $ligacao->prepare("UPDATE utilizador SET nome = :nome, morada = :morada, email = :email, nr_telemovel = :telefone WHERE id = :id");
  $comando->execute($parametros);
  header('Location: perfil.php');
} catch (PDOException $err) {
echo $err;
}

$ligacao = null;
?>
