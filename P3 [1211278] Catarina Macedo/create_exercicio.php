<?php
include 'configs/db.php';
include 'helper/funcao.php';

session_start();

if (!check_session()) {
  header('Location: Homepage.php');
  exit();
}

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // form validation
  $validation_errors = [];
  // text_name verifica se o campo nome está preenchido
  if (empty($_POST['exercise'])) {
    $validation_errors[] = "O nome é de preenchimento obrigatório.";
  } else {
    if (strlen($_POST['exercise']) < 3 || strlen($_POST['exercise']) > 50) {
      $validation_errors[] = "O exercício deve ter entre 3 e 50 caracteres.";
    }
  }

  // verifica se o campo equipamento está preenchido
  if (empty($_POST['equipment'])) {
    $validation_errors[] = "É obrigatório definir o equipamento.";
  }

  // valida grupo muscular
  if (empty($_POST['muscleGroup'])) {
    $validation_errors[] = "Grupo muscular é de preenchimento obrigatório.";
  }

  if (empty($validation_errors)) {
    $nomeExercicio = $_POST['exercise'];
    $id_equipamento = $_POST['equipment'];
    $id_grupo_muscular = $_POST['muscleGroup'];

    try {
      // ligação
      $ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

      // Verifica se já existe um exercício com esse nome
      $comando = $ligacao->prepare("SELECT id FROM exercicio WHERE nome = :nomeExercicio");
      $comando->execute(['nomeExercicio' => $nomeExercicio]);
      $resultados = $comando->fetchAll(PDO::FETCH_OBJ);

      if (!empty($resultados)) {
        $server_error = "Já existe um Exercício com esse nome.";
      } else {
        // Inserir novo exercício
        $comando = $ligacao->prepare("INSERT INTO exercicio (nome, id_grupo_muscular, id_equipamento) VALUES (:nomeExercicio, :id_grupo_muscular, :id_equipamento)");
        $comando->execute([
          'nomeExercicio' => $nomeExercicio,
          'id_grupo_muscular' => $id_grupo_muscular,
          'id_equipamento' => $id_equipamento
        ]);
        header('Location: exercise_table.php');
        exit();
      }
    } catch (PDOException $err) {
      $erro = "Aconteceu um erro no SQL: " . $err->getMessage();
    }

    // fechar a ligação
    $ligacao = null;
  }
}

$queryEquipamento = $ligacao->prepare("SELECT * FROM equipamento");
$queryEquipamento->execute();
$equipamentos = $queryEquipamento->fetchAll(PDO::FETCH_OBJ);

$queryGrupoMuscular = $ligacao->prepare("SELECT * FROM grupo_muscular");
$queryGrupoMuscular->execute();
$grupoMuscular = $queryGrupoMuscular->fetchAll(PDO::FETCH_OBJ);

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
      <h2 class="text-2xl font-bold mb-4">Criar Exercício</h2>
      <form method="POST" action="create_exercicio.php">
        <div class="mb-4">
          <label for="search" class="block text-sm font-bold mb-2">Exercício</label>
          <input id="search" name="exercise" type="text" class="input input-bordered mt-1 w-full" autocomplete="off" list="suggestions" required>
          <datalist id="suggestions">
            <?php foreach ($exercicios as $exercicio) : ?>
              <option><?= $exercicio->nome ?></option>
            <?php endforeach; ?>
          </datalist>
        </div>
        <div class="mb-4">
          <label for="equipment" class="block text-sm font-bold mb-2">Equipamento</label>
          <select id="equipment" name="equipment" class="select select-bordered w-full">
            <?php foreach ($equipamentos as $equipamento) : ?>
              <option value="<?= $equipamento->id ?>"><?= $equipamento->descricao ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-4">
          <label for="muscleGroup" class="block text-sm font-bold mb-2">Grupo Muscular</label>
          <select id="muscleGroup" name="muscleGroup" class="select select-bordered w-full">
            <?php foreach ($grupoMuscular as $grupo) : ?>
              <option value="<?= $grupo->id ?>"><?= $grupo->nome ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
      </form>
      <?php if (!empty($validation_errors)) : ?>
        <div class="alert alert-error mt-4">
          <ul>
            <?php foreach ($validation_errors as $error) : ?>
              <li><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
include 'layouts/footer.php';
?>
