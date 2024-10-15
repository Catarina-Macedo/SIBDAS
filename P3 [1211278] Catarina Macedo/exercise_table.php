<?php
session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
  header('Location: Homepage.php');
}

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);

$comando = $ligacao->prepare("
        SELECT 
            e.nome AS nome_exercicio, 
            eq.descricao AS descricao_equipamento, 
            te.tipo AS nome_tipo_equipamento, 
            gm.nome AS nome_grupo_muscular
        FROM 
            exercicio e
        JOIN 
            equipamento eq ON e.id_equipamento = eq.id
        JOIN 
            tipo_equipamento te ON eq.id_tipo = te.id
        JOIN 
            grupo_muscular gm ON e.id_grupo_muscular = gm.id;

    ");
$comando->execute();
$exercicios = $comando->fetchAll(PDO::FETCH_OBJ);


include 'layouts/header.php';
include 'layouts/navBar.php';
?>

<div class="img1">
  <!--Conteudo-->
  <div class="container mx-auto p-8 pb-20">
    <!-- Botão para criar novo cliente -->
    <div class="mb-6 text-left">
      <button class="btn btn-success text-white" onclick="location.href='create_exercicio.php'">Criar Novo exercício</button>
    </div>
    <h2 class="text-3xl font-bold mb-6 text-center">Biblioteca de Exercícios</h2>
    <div class="grid grid-cols-1">
      <!-- Exercícios de Musculação -->
      <div class="bg-white p-6 shadow-lg rounded-lg">
        <h3 class="text-2xl font-bold mb-4">Exercícios</h3>
        <div class="overflow-x-auto">
          <table class="table w-full">
            <thead>
              <tr>
                <th>Exercício</th>
                <th>Grupo Muscular</th>
                <th>Equipamento</th>
                <th>Tipo de Exercício</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
            <tbody>
              <?php if (count($exercicios) == 0) : ?>
                <tr>
                  <td colspan='7'>Nenhum registro encontrado</td>
                </tr>
              <?php else : ?>
                <?php foreach ($exercicios as $exercicio) : ?>
                  <tr>
                    <td><?= $exercicio->nome_exercicio ?></td>
                    <td><?= $exercicio->nome_grupo_muscular  ?></td>
                    <td><?= $exercicio->descricao_equipamento ?></td>
                    <td><?= $exercicio->nome_tipo_equipamento  ?></td>
                    <td><a href="" class="btn btn-error">Eliminar</a></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'layouts/footer.php';
?>