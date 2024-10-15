<?php
session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
  header('Location: Homepage.php');
  exit();
}

$parametros = [        
  ':id' => $_SESSION['user'],
];

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
$comando = $ligacao->prepare("SELECT * FROM utilizador WHERE id = :id");
$comando->execute($parametros);
$resultadoCliente = $comando->fetch(PDO::FETCH_OBJ);

include 'layouts/header.php';
include 'layouts/navBar.php';
?>
<!--Conteudo-->
<div class="img1">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 shadow-lg rounded-lg w-full max-w-md">
      <div class="text-center mb-6">
        <img src="https://via.placeholder.com/150" alt="Profile Picture" class="mx-auto mb-4 rounded-full shadow-md">
        <h1 class="text-2xl font-bold" id="clientName"><?= ($resultadoCliente->nome) ?></h1>
      </div>
      <form id="editForm" method="POST" action="update_profile.php">
        <div class="space-y-4">
          <div class="flex items-center">
            <label class="w-1/3 font-bold">Nome:</label>
            <input type="text" class="w-2/3 bg-gray-200 p-2 rounded" id="name" name="name" value="<?= ($resultadoCliente->nome) ?>">
          </div>
          <div class="flex items-center">
            <label class="w-1/3 font-bold">Morada:</label>
            <input type="text" class="w-2/3 bg-gray-200 p-2 rounded" id="address" name="address" value="<?= ($resultadoCliente->morada) ?>">
          </div>
          <div class="flex items-center">
            <label class="w-1/3 font-bold">Email:</label>
            <input type="email" class="w-2/3 bg-gray-200 p-2 rounded" id="email" name="email" value="<?= ($resultadoCliente->email) ?>">
          </div>
          <div class="flex items-center">
            <label class="w-1/3 font-bold">Numero de telemovel:</label>
            <input type="text" class="w-2/3 bg-gray-200 p-2 rounded" id="phone" name="phone" value="<?= ($resultadoCliente->nr_telemovel) ?>">
          </div>
        </div>
        <div class="text-center mt-6">
          <button type="submit" id="editButton" class="btn btn-success">Editar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php
include 'layouts/footer.php';
?>
