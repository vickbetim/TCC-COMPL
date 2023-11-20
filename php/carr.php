<?php
/* carrinho de compra */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include_once 'conexao.php';
include_once 'funcaodata.php';

$pdo = conectar();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

if (isset($_GET['acao'])) {

    if ($_GET['acao'] == 'add') {
        $id = intval($_GET['id']);
        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 1;
        } else {
            $_SESSION['carrinho'][$id] += 1;
        }
    }

    if ($_GET['acao'] == 'del') {
        $id = intval($_GET['id']);
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    if ($_GET['acao'] == 'up' && count($_SESSION['carrinho']) != 0) {
        if (is_array($_POST['prod'])) {
            foreach ($_POST['prod'] as $id => $qtd) {
                $id = intval($id);
                $qtd = intval($qtd);
                if (!empty($qtd) || $qtd <> 0) {
                    $_SESSION['carrinho'][$id] = $qtd;
                } else {
                    unset($_SESSION['carrinho'][$id]);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
    <h2>Carrinho de Compras</h2>
    <table>

        <thead>
            <tr>
                <th width="240">Produto</th>
                <th width="79">Quantidade</th>
                <th width="89">Pre&ccedil;o</th>
                <th width="100">img</th>
                <th width="64">Remover</th>
            </tr>
        </thead>
        <form action="?acao=up" method="post">
            <tfoot>
                <tr>
                    <td colspan="5">
                        <input type="submit" value="Atualizar Carrinho" class="btn btn-warning" />
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <a class="btn btn-primary" href="testedeproduto.php">Continuar Comprando</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <input class="btn btn-info" type="submit" name="finalizaVenda" value="Finaliza Venda" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if (count($_SESSION['carrinho']) == 0) {
                    echo '<tr><td colspan="5">Não há produto no carrinho</td></tr>';
                } else {
                    $total = 0;

                    foreach ($_SESSION['carrinho'] as $id => $qtd) {
                        $sql = "SELECT * FROM tb_produtos WHERE cod_produto = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(":id", $id);
                        $stmt->execute();
                        $rp = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($rp) {
                            $produto = $rp['descricao'];
                            $estoque = isset($rp['estoque']) ? $rp['estoque'] : 0;
                            $valor = isset($rp['valor']) ? number_format($rp['valor'], 2, ',', '.') : 0;

                            // Exibe os produtos no carrinho
                            echo '<tr>
                                    <td>' . $produto . '</td>
                                    <td><input type="text" size="3" name="prod[' . $id . ']" value="' . $qtd . '" /></td>
                                    <td>R$ ' . $valor . '</td>
                                    <td><a href="?acao=del&id=' . $id . '"><img src="img/lixo.png" width="30px" heigth="30px"></a></td>
                                </tr>';

                            // Calcula o total
                            $total += floatval(str_replace(',', '.', str_replace('.', '', $valor))) * $qtd;


                        } else {
                            echo "Produto não encontrado.";
                        }
                    }

                    // Exibe o total fora do loop
                    echo '<tr>
                            <td colspan="3">Total</td>
                            <td>R$ ' . number_format($total, 2, ',', '.') . '</td>
                        </tr>';
                }
                ?>
            </tbody>
        </form>
    </table>
</body>

</html>
<?php
// Restante do seu código...
?>
