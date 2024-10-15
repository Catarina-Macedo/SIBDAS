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


  $systolic = (float)$_POST['systolic'];
  $diastolic = (float)$_POST['diastolic'];
  $heartRate = (float)$_POST['heartRate'];
  $spo2 = (float)$_POST['spo2'];

  $id_cliente = $_POST['id_cliente'];

  try {
    $ligacao->exec("INSERT INTO sinal (spo2, freq_card, press_art_min, press_art_max, data, id_cliente)
    VALUES ($spo2, $heartRate, $diastolic, $systolic,  NOW(), '$id_cliente')");
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
      <h2 class="text-2xl font-bold mb-4">Criar Nova Tabela de Sinais Vitais</h2>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="systolic">
            Pressão Arterial Máxima (mmHg)
          </label>
          <input type="number" step="1" id="systolic" name="systolic" placeholder="Pressão Arterial Máxima" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="diastolic">
            Pressão Arterial Mínima (mmHg)
          </label>
          <input type="number" step="1" id="diastolic" name="diastolic" placeholder="Pressão Arterial Mínima" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="heartRate">
            Frequência Cardíaca (bpm)
          </label>
          <input type="number" step="1" id="heartRate" name="heartRate" placeholder="Frequência Cardíaca" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="spo2">
            SpO2 (%)
          </label>
          <input type="number" step="1" id="spo2" name="spo2" placeholder="SpO2" class="input input-bordered w-full" required>
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
