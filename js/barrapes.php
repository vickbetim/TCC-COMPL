<?php
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Barra de Pesquisa</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <h2 class="mt-3">Barra de Pesquisa</h2>
          <form method="GET" class="input-group">
            <input
              type="text"
              name="pesquisa"
              class="form-control form-control-lg"
            />
            <button type="submit"><i class="material-icons">search</i></button>
          </form>
          <?php 
            if ($_SERVER['REQUEST_METHOD'] === "GET") {
                if (isset($_GET['pesquisa']) && !empty($_GET['pesquisa'])) {
                    $pesquisa = $_GET['pesquisa'] . "%";
                    // %termo% === %coelho%
                    // Realizar a pesquisa com base no tipo selecionado
                    $sql = "SELECT * FROM tb_produtos WHERE descricao LIKE :pesquisa AND ativo = 'S'";

                    // Executo o SQL
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":pesquisa", $pesquisa);
                    $stmt->execute();
                    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Se a busca teve êxito significa que achou
                    if (count($resultado) > 0) {
                        echo "<h3>Resultado da pesquisa</h3>";
                        foreach ($resultado as $r) {
                            echo "<p>Descrição: " . $r['descricao'] . "</p>";
                            echo "<p>Valor: " . $r['valor'] . "</p>";
                            // Adicione mais campos conforme necessário
                            echo '<hr />';
                        }
                    } else {
                        echo "<h3>Nenhum resultado encontrado</h3>";
                    }
                }
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>