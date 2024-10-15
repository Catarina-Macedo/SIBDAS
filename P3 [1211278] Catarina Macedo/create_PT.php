<?php

session_start();

//o criar plano de treino é criar execução acho 
include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
  header('Location: Homepage.php');
}

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

//verificar se o pedido é do tipo POST então vamos processar o formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $exercise = $_POST['exercise'];
  $repetitions = $_POST['repetitions'];
  $sets = $_POST['sets'];
  $rest = $_POST['rest'];
  $duration = $_POST['duration'];
  $load = $_POST['load'];
  $id_cliente = $_POST['id_cliente'];

  $validation_errors = [];

  if (empty($repetitions) || empty($sets) || empty($rest) || empty($duration) || empty($load) || empty($id_cliente)) {
    $validation_errors[] = 'Todos os campos são obrigatórios'; 
  }

  $queryId = $ligacao->prepare("SELECT UUID() as id");
  $queryId->execute();
  $idExec = $queryId->fetchColumn();

  if (count($validation_errors) == 0) {
    try {
      // ligação
      $ligacao->exec("INSERT INTO execucao (id, series, repeticoes, carga_kg, tempo_duracao, tempo_descanso, id_exercicio)
      VALUES ('$idExec', $sets, $repetitions, $load, $duration, $rest, '$exercise')");

      $queryPT = $ligacao->prepare("SELECT * FROM plano_treino WHERE id_cliente = '$id_cliente' LIMIT 1");
      $queryPT->execute();
      $planoTreino = $queryPT->fetchAll(PDO::FETCH_OBJ);

      if (count($planoTreino) == 0) {
        $queryId = $ligacao->prepare("SELECT UUID() as id");
        $queryId->execute();
        $idPT = $queryId->fetchColumn();

        $id_fisiologista = $_SESSION['user'];

        $ligacao->exec("INSERT INTO plano_treino (id, data, id_cliente, id_fisiologista)
        VALUES ('$idPT', NOW(), '$id_cliente', '$id_fisiologista')");

      } else {
        $idPT = $planoTreino[0]->id;
      }

      $ligacao->exec("INSERT INTO plano_treino_execucao (id_plano_treino, id_execucao)
      VALUES ('$idPT', '$idExec')");

      header('Location: client_info.php?id_cliente=' . $id_cliente);
    } catch (PDOException $err) {
      $erro = "Aconteceu um erro no SQL !";
    }
  }
      // fechar a ligação
      $ligacao = null;
}

$queryExercicios = $ligacao->prepare("SELECT * FROM exercicio");
$queryExercicios->execute();
$exercicios = $queryExercicios->fetchAll(PDO::FETCH_OBJ);

include 'layouts/header.php';
include 'layouts/navBar.php';
?>


<!--Conteudo-->
<div class="img1">
  <div class="container mx-auto p-4">
    <div class="bg-white p-10 shadow-lg rounded-lg mb-6">
      <h2 class="text-2xl font-bold mb-4">Criar Plano de Treino</h2>
      <form method="POST" action="create_PT.php">
        <div class="mb-4">
          <label for="exercise" class="block text-sm font-bold mb-2">Exercício</label>
          <select id="exercise" name="exercise" class="select select-bordered w-full">
            <?php foreach ($exercicios as $exercicio) : ?> 
              <option value="<?= $exercicio->id?>"><?= $exercicio->nome?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="repetitions">
            Repetições
          </label>
          <input type="number" id="repetitions" name="repetitions" placeholder="Número de repetições" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="sets">
            Séries
          </label>
          <input type="number" id="sets" name="sets" placeholder="Número de séries" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="rest">
            Descanso (minutos)
          </label>
          <input type="number" id="rest" name="rest" placeholder="Tempo de descanso em minutos" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="duration">
            Duração (minutos)
          </label>
          <input type="number" id="duration" name="duration" placeholder="Tempo de duração em minutos" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="load">
            Carga (Kg)
          </label>
          <input type="number" id="load" name="load" placeholder="Carga em quilogramas" class="input input-bordered w-full" required>
        </div>

        <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $_GET['id_cliente']?>" />

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
