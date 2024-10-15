<?php
session_start();

include 'configs/db.php';
include 'helper/funcao.php';

if (!check_session()) {
  header('Location: Homepage.php');
}

$parametros = [        
  ':id' => $_GET['id_cliente'],
];

$ligacao = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
$comando = $ligacao->prepare("SELECT * FROM utilizador WHERE id = :id");
$comando->execute($parametros);
$resultadoCliente = $comando->fetchAll(PDO::FETCH_OBJ);

$comando = $ligacao->prepare("
  SELECT
    ex.id AS exec_id, 
    exe.nome AS exercicio, 
    eq.descricao AS equipamento, 
    te.tipo AS tipo, 
    ex.repeticoes,
    ex.series,
    ex.carga_kg,
    ex.tempo_descanso,
    ex.tempo_duracao,
    gm.nome AS grupo_muscular
  FROM plano_treino pt
  JOIN plano_treino_execucao pte
  ON pte.id_plano_treino = pt.id
  JOIN execucao ex
  ON ex.id = pte.id_execucao
  JOIN exercicio exe
  ON exe.id = ex.id_exercicio
  JOIN equipamento eq
  ON eq.id = exe.id_equipamento
  JOIN tipo_equipamento te
  ON eq.id_tipo = te.id
  JOIN grupo_muscular gm
  ON gm.id = exe.id_grupo_muscular
  WHERE pt.id_cliente = :id;
");
$comando->execute($parametros);
$exercicios = $comando->fetchAll(PDO::FETCH_OBJ);

$comando = $ligacao->prepare("SELECT * FROM sinal WHERE id_cliente = :id");
$comando->execute($parametros);
$sinais = $comando->fetchAll(PDO::FETCH_OBJ);

$comando = $ligacao->prepare("SELECT * FROM medida WHERE id_cliente = :id");
$comando->execute($parametros);
$medidas = $comando->fetchAll(PDO::FETCH_OBJ);


include 'layouts/header.php';
include 'layouts/navBar.php';
?>
<!--Conteudo-->
<div class="img1">
  <div class="container mx-auto p-4">
    <div class="bg-white p-10 shadow-lg rounded-lg">
      <div class="text-center">
        <img src="assets/images/fundo_150x150.jpg" alt="Foto do Cliente" class="mx-auto mb-4 rounded-full shadow-md">
        <h2 id="clientName" class="text-2xl font-bold mb-2">
          <?= $resultadoCliente[0]->nome ?>
        </h2>
      </div>
      <form id="profileForm" class="hidden">
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="name">Nome</label>
          <input type="text" id="name" name="name" class="input input-bordered w-full colorGray">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="birthdate">Data de Nascimento</label>
          <input type="date" id="birthdate" name="birthdate" class="input input-bordered w-full colorGray">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-bold mb-2" for="email">Email</label>
          <input type="email" id="email" name="email" class="input input-bordered w-full colorGray">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-outline btn-warning p-2">Salvar</button>
          <button type="button" id="cancelButton" class="btn btn-error">Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Tabela de Plano de Treino -->
  <div class="bg-white p-10 shadow-lg rounded-lg m-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Tabela Plano de Treino</h2>
      <button class="btn btn-success text-white" onclick="location.href='create_PT.php?id_cliente=<?= $_GET['id_cliente'] ?>'">
        Criar Nova Linha</button>
    </div>
    <div class="overflow-x-auto">
      <table class="table w-full">
        <thead>
          <tr>
            <th>Exercício</th>
            <th>Equipamento</th>
            <th>Tipo</th>
            <th>Repetições</th>
            <th>Séries</th>
            <th>Carga Kg</th>
            <th>Descanso min</th>
            <th>Duração min</th>
            <th>Grupo Muscular</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($exercicios) == 0) : ?>
              <tr><td colspan='7'>Nenhum registro encontrado</td></tr>
            <?php else: ?>
              <?php foreach ($exercicios as $exercicio) : ?>
                <tr>
                  <td><?= $exercicio->exercicio ?></td>
                  <td><?= $exercicio->equipamento ?></td>
                  <td><?= $exercicio->tipo ?></td>
                  <td><?= $exercicio->repeticoes ?></td>
                  <td><?= $exercicio->series ?></td>
                  <td><?= $exercicio->carga_kg ?></td>
                  <td><?= $exercicio->tempo_descanso ?></td>
                  <td><?= $exercicio->tempo_duracao ?></td>
                  <td><?= $exercicio->grupo_muscular ?></td>
                  <td><a href="eliminar_execucao.php?id_cliente=<?= $_GET['id_cliente']?>&id_exec=<?= $exercicio->exec_id ?>" 
                  class="btn btn-error">Eliminar</a></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tabela de Medidas -->
  <div class="bg-white p-10 shadow-lg rounded-lg m-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Tabela de Medidas</h2>
      <button class="btn btn-success text-white" onclick="location.href='create_medidas.php?id_cliente=<?= $_GET['id_cliente'] ?>'">Criar Nova Linha</button>
    </div>
    <div class="overflow-x-auto">
      <table class="table w-full">
        <thead>
          <tr>
            <th>Data</th>
            <th>Peso</th>
            <th>Altura</th>
            <th>IMC</th>
            <th>% Massa Gorda</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($medidas) == 0) : ?>
            <tr><td colspan='7'>Nenhum registro encontrado</td></tr>
          <?php else: ?>
            <?php foreach ($medidas as $medida) : ?>
              <tr>
                <td><?= $medida->data ?></td>
                <td><?= $medida->peso ?></td>
                <td><?= $medida->altura ?></td>
                <td><?= $medida->imc ?></td>
                <td><?= $medida->percentagem_massa_gorda ?></td>
                <td><a href="eliminar_medida.php?id_cliente=<?= $_GET['id_cliente']?>&id_medida=<?= $medida->id ?>" class="btn btn-error">Eliminar</a></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tabela de Sinais Vitais -->
  <div class="bg-white p-10 shadow-lg rounded-lg m-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Tabela de Sinais Vitais</h2>
      <button class="btn btn-success text-white" onclick="location.href='create_signals.php?id_cliente=<?= $_GET['id_cliente'] ?>'">Criar Nova Linha</button>
    </div>
    <div class="overflow-x-auto">
      <table class="table w-full">
        <thead>
          <tr>
            <th>Data</th>
            <th>Pressão Arterial Máxima</th>
            <th>Pressão Arterial Mínima</th>
            <th>Frequência Cardíaca</th>
            <th>SpO2</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($sinais) == 0) : ?>
            <tr><td colspan='7'>Nenhum registro encontrado</td></tr>
          <?php else: ?>
            <?php foreach ($sinais as $sinal) : ?>
              <tr>
                <td><?= $sinal->data ?></td>
                <td><?= $sinal->press_art_max ?></td>
                <td><?= $sinal->press_art_min ?></td>
                <td><?= $sinal->freq_card ?></td>
                <td><?= $sinal->spo2 ?></td>
                <td><a href="eliminar_sinal.php?id_cliente=<?= $_GET['id_cliente']?>&id_sinal=<?= $sinal->id ?>" class="btn btn-error">Eliminar</a></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
include 'layouts/footer.php';
?>
