<?php
include 'configs/db.php';
include 'helper/funcao.php';
session_start();

if (!check_session()) {
  header('Location: Homepage.php');
}

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // form validation
  $validation_errors = [];

  // valida a percentagem de massa gorda
  if (empty($_POST['bodyFat'])) {
    $validation_errors[] = "É obrigatório colocar a percentagem de massa gorda.";
  } 

  // Valida o peso
  if (empty($_POST['weight'])) {
    $validation_errors[] = "É obrigatório colocar o peso.";
  }

  // Valida a altura
  if (empty($_POST['height'])) {
    $validation_errors[] = "É obrigatório colocar a altura.";
  }


  $bodyfatMedidas = (float)$_POST['bodyFat'];
  $weightMedidas = (float)$_POST['weight'];
  $heightMedidas = (float)$_POST['height'];
  $imc = $weightMedidas / ($heightMedidas * 0.01 * $heightMedidas * 0.01);
  $imc = number_format((float)$imc, 2, '.', '');
  $id_cliente = $_POST['id_cliente'];


  try {
    $ligacao->exec("INSERT INTO medida (percentagem_massa_gorda, imc, peso, altura, data, id_cliente)
    VALUES ($bodyfatMedidas, $imc, $weightMedidas, $heightMedidas, NOW(), '$id_cliente')");
    header('Location: client_info.php?id_cliente=' . $id_cliente);
  } catch (PDOException $err) {
    $erro = "Aconteceu um erro no SQL !";

  }

  // fechar a ligação
  $ligacao = null;
}

include 'layouts/header.php';
include 'layouts/navBar.php';
?>


<!--Conteudo-->
<div class="img1">
  <div class="container mx-auto p-4">
    <div class="bg-white p-10 shadow-lg rounded-lg mb-6">
      <h2 class="text-2xl font-bold mb-4">Criar Nova Tabela de Medidas</h2>
      <form method="POST" action="">
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="bodyFat">
            Percentagem de Massa Gorda (%)
          </label>
          <input type="number" step="0.1" id="bodyFat" name="bodyFat" placeholder="Percentagem de Massa Gorda" class="form-control" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="weight">
            Peso (kg)
          </label>
          <input type="number" step="0.1" id="weight" name="weight" placeholder="Peso" class="form-control" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="height">
            Altura (cm)
          </label>
          <input type="number" step="0.1" id="height" name="height" placeholder="Altura" class="form-control" required>
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