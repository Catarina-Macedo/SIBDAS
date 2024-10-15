<?php

session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
    header('Location: Homepage.php');
    exit();
}

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
$queryClientes = $ligacao->prepare("
    SELECT genero, COUNT(*) as total 
    FROM utilizador 
    WHERE id_fisiologista = :id 
    GROUP BY genero
");
$queryClientes->execute([':id' => $_SESSION['user']]);
$clientes = $queryClientes->fetchAll(PDO::FETCH_OBJ);

// Initialize counts
$maleCount = 0;
$femaleCount = 0;

// Process results
foreach ($clientes as $cliente) {
    if ($cliente->genero === 'Male') {
        $maleCount = $cliente->total;
    } elseif ($cliente->genero === 'Female') {
        $femaleCount = $cliente->total;
    }
}

include 'layouts/header.php';
include 'layouts/navBar.php';
?>

<!--Conteudo-->
<div class="img1">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 shadow-lg rounded-lg w-full max-w-2xl">
      <h1 class="text-3xl font-bold text-center mb-6">Estatística</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <canvas id="myBarChart" width="400" height="400"></canvas>
        </div>
        <div>
          <canvas id="myPieChart" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'layouts/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const maleCount = <?= $maleCount ?>;
  const femaleCount = <?= $femaleCount ?>;
  
  const ctxBar = document.getElementById('myBarChart').getContext('2d');
  const ctxPie = document.getElementById('myPieChart').getContext('2d');

  const data = {
    labels: ['Masculino', 'Feminino'],
    datasets: [{
      label: 'Número de Clientes',
      data: [maleCount, femaleCount],
      backgroundColor: ['#36A2EB', '#FF6384'],
      borderColor: ['#36A2EB', '#FF6384'],
      borderWidth: 1
    }]
  };

  const configBar = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  const configPie = {
    type: 'pie',
    data: data,
    options: {
      responsive: true,
    }
  };

  const myBarChart = new Chart(ctxBar, configBar);
  const myPieChart = new Chart(ctxPie, configPie);
</script>
