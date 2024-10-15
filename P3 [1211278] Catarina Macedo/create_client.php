<?php

session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
  header('Location: Homepage.php');
}

//verificar se o pedido é do tipo POST então vamos processar o formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // form validation
  $validation_errors = [];
  // text_name verifica se o campo nome está preenchido
  if (empty($_POST['name_client'])) {
    $validation_errors[] = "Nome é de preenchimento obrigatório."; //caso não esteja preenchido
  } else {
    if (strlen($_POST['name_client']) < 3 || strlen($_POST['name_client']) > 50) {
      $validation_errors[] = "O nome deve ter entre 3 e 50 caracteres."; //caso tenha menos de 3 ou mais de 50 caracteres então apresenta a mensagem
    }
  }

  // genero verifica se o campo genero está preenchido
  if (empty($_POST['gender_client'])) {
    $validation_errors[] = "É obrigatório definir o género.";
  }
  
  // valida email
if (empty($_POST['email'])) {
  $validation_errors[] = "Email é de preenchimento obrigatório.";
} else {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $validation_errors[] = "Email não é válido.";
  }
}


// Valida Telefone
if (empty($_POST['phone'])) {
  $validation_errors[] = "Telefone é de preenchimento obrigatório.";
}

$nomeCliente = $_POST['name_client'];
$emailCliente = $_POST['email'];
$dataNascimento = $_POST['date'];
$telemovelCliente = $_POST['phone'];
$sexoCliente = $_POST['gender'];
$moradaCliente = $_POST['address'];
$passwordCliente = $_POST['password'];
$idFisiologista = $_SESSION['user'];

try {
  // ligação
  $ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
  $resultados = $ligacao->query("SELECT id FROM utilizador WHERE nr_telemovel='$telemovelCliente'")->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $err) {
  $erro = "Aconteceu um erro na ligação.";
}
// Verificar se há resultados
if (empty(!$resultados)) {
  $server_error = "Já existe um cliente com esse Telefone.";
}

$ligacao = null;

if (empty($server_error)) {
  try {
  // ligação
  $ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);// execução da query
  $ligacao->exec("INSERT INTO utilizador (nome, genero, data_nascimento, morada, nr_telemovel, email, password, id_fisiologista)
  VALUES ('$nomeCliente', '$sexoCliente', '$dataNascimento', '$moradaCliente', '$telemovelCliente', '$emailCliente', '$passwordCliente', '$idFisiologista')");
  header('Location: Homepage.php');
  } catch (PDOException $err) {
  $erro = "Aconteceu um erro no SQL !";
  }
  // fechar a ligação
  $ligacao = null;
  }

}

include 'layouts/header.php';
include 'layouts/navBar.php';
?>

<!--Conteudo-->
<div class="img1">
  <div class="container mx-auto p-4">
    <div class="bg-white p-10 shadow-lg rounded-lg mb-6">
      <h2 class="text-2xl font-bold mb-4">Criar Novo Cliente</h2>
      <form method="POST" action="create_client.php">
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="name">
            Nome
          </label>
          <input type="text" id="name" name="name_client" placeholder="Nome completo" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="gender_client">
            Gênero
          </label>
          <select id="gender" name="gender" class="select select-bordered w-full" required>
            <option disabled selected>Selecione o género</option>
            <option value="Male">Masculino</option>
            <option value="Female">Feminino</option>
            <option value="Other">Outro</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="dob">
            Data de Nascimento
          </label>
          <input type="date" id="dob" name="date" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="address">
            Morada
          </label>
          <input type="text" id="address" name="address" placeholder="Morada completa" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="phone">
            Número de Telemóvel
          </label>
          <input type="tel" id="phone" name="phone" placeholder="Número de telemóvel" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="email">
            Email
          </label>
          <input type="email" id="email" name="email" placeholder="Email" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="email">
            Password
          </label>
          <input type="password" id="password" name="password" placeholder="password" class="input input-bordered w-full" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'layouts/footer.php';
?>