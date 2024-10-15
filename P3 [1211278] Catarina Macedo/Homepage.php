<?php
session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: login.php');
    return;
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  // check if username is valid email and between 5 and 50 chars
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $validation_errors[] = 'O email tem que ser um email válido.';
  }

  // check if username is between 5 and 50 chars
  if (strlen($email) < 5 || strlen($email) > 50) {
    $validation_errors[] = 'O email deve ter entre 5 e 50 caracteres.';
  }
  // check if password is valid
  if (strlen($password) < 6 || strlen($password) > 12) {
    $validation_errors[] = 'A password deve ter entre 6 e 12 caracteres.';
  }

  if (!empty($validation_errors)) {
    $_SESSION['validation_errors'] = $validation_errors;
    header('Location: login.php');
    return;
  }

  $parametros = [        
    ':u' => $email,
    ':p' => $password
  ];

  $ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

  $comando = $ligacao->prepare("SELECT * FROM utilizador WHERE email = :u AND password = :p");
  $comando->execute($parametros);
  $resultados = $comando->fetchAll(PDO::FETCH_OBJ);

  
  //se tiver  0 não houve ligação com a base de dados
  if (count($resultados) == 0) {
    $result['status'] = 0;
  } else {
    $result['status'] = 1;
  }
 

  if (!$result['status']) {
    // invalid login
    $_SESSION['server_error'] = 'Login inválido';
    header('Location: login.php');
    return;
  }

  $comando = $ligacao->prepare("SELECT id_funcao FROM funcao_utilizador WHERE id_utilizador = :id_utilizador");
  $comando->execute([':id_utilizador' => $resultados[0]->id]);
  $role = $comando->fetch(PDO::FETCH_OBJ);
  
  if($role->id_funcao == '96b1422e-2e1f-11ef-9611-fc3fdb8fa140'){
    $_SESSION['server_error'] = 'Login inválido';
    header('Location: login.php');
    exit();
  }else{
    $_SESSION['user'] = $resultados[0]->id;
  }

}

include 'layouts/header.php';
include 'layouts/navBar.php';
?>

<div class="img1">
  <!--Conteudo-->
  <div class="container mx-auto p-4">
    <div class="mb-6 text-left">
      <a class="btn btn-success text-white" href="create_client.php">Criar Novo
        Cliente</a>
    </div>

    <?php
      $ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
      $queryClientes = $ligacao->prepare("SELECT * FROM utilizador WHERE id_fisiologista = :id");
      $queryClientes->execute([':id' => $_SESSION['user']]);
      $clientes = $queryClientes->fetchAll(PDO::FETCH_OBJ);
    ?>

    <?php if(count($clientes) == 0) : ?>
      <div class="m-10 badge badge-sucess">
        <p>Não existem clientes</p>
      </div>
      
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 animate__bounceIn">
        <?php foreach ($clientes as $cliente) : ?>
          <div class="bg-white p-6 shadow-lg rounded-lg">
          <img src="assets/images/fundo_150x150.jpg" alt="Placeholder Image" class="width150 mx-auto mb-4 rounded-full shadow-md" style="width: 150px;">
            <h2 class="text-center text-xl font-bold mb-2"><?= $cliente->nome ?></h2>
            <div class="text-center">
              <a class="btn btn-success text-white" href="client_info.php?id_cliente=<?= $cliente->id ?>">Mais
                informações</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php
include 'layouts/footer.php';
?>