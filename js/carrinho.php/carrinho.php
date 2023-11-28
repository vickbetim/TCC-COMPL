<?php
/* Carrinho de compras */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include_once 'conexao2.php'; // Certifique-se de que o arquivo esteja no diretório correto.
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
    } elseif ($_GET['acao'] == 'del') {
        $id = intval($_GET['id']);
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    } elseif ($_GET['acao'] == 'up' && count($_SESSION['carrinho']) != 0) {
        if (is_array($_POST['prod'])) {
            foreach ($_POST['prod'] as $id => $qtd) {
                $id = intval($id);
                $qtd = intval($qtd);
                if (!empty($qtd) || $qtd != 0) {
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
</head>
<body>
<h2>Carrinho de Compras</h2>
<table>
    <thead>
    <tr>
        <th width="240">Produto</th>
        <th width="79">Quantidade</th>
        <th width="89">Preço</th>
        <th width="100">SubTotal</th>
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
                <a class="btn btn-primary" href="lista_produto.php">Continuar Comprando</a>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <input class="btn btn-info" type="submit" name="finalizaVenda" value="Finalizar Venda" />
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php if (count($_SESSION['carrinho']) == 0) {
            echo '
            <tr>
                <td colspan="5">Não há produtos no carrinho</td>
            </tr>
            ';
        } else {
            $total = 0;
            $itens = array(); // Inicialize o array $itens
            foreach ($_SESSION['carrinho'] as $id => $qtd) {
                $sql = "SELECT * FROM tb_produtos WHERE cod_produto = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                $rp = $stmt->fetch(PDO::FETCH_ASSOC);
                $produto = $rp['descricao'];
                $preco = number_format($rp['preco'], 2, ',', '.');
                $sub = number_format($rp['preco'] * $qtd, 2, ',', '.');
                $total += $rp['preco'] * $qtd;
                $itens[] = array(
                    "produto" => $rp['idproduto'],
                    "quantidade" => $qtd,
                    "preco_unitario" => $preco,
                    "preco_total" => $sub

                    // CREATE TABLE tb_produtos (
                    //     cod_produto INT AUTO_INCREMENT PRIMARY KEY,
                    //     ativo VARCHAR(1) CHECK (ativo IN ('S', 'N')),
                    //     valor FLOAT(5,2),
                    //     tamanho INT,
                        // descricao
                );
                echo '
                <tr>
                    <td>' . $produto . '</td>
                    <td>
                        <input type="text" size="3" name="prod[' . $id . ']" value="' . $qtd . '" />
                    </td>
                    <td>R$ ' . $preco . '</td>
                    <td>R$ ' . $sub . '</td>
                    <td><a href="?acao=del&id=' . $id . '"><img src="img/lixo.png" width="30px" height="30px"></a></td>
                </tr>';
            }
            $total = number_format($total, 2, ',', '.');
            echo '
            <tr>
                <td colspan="3">Total</td>
                <td>R$ ' . $total . '</td>
            </tr>';
        } ?>
        </tbody>
    </form>
    </table>
</body>
</html>
<?php 
if (isset($_POST['finalizaVenda'])) {
    // A partir daqui, o código para finalizar a venda
    // Verifique se as variáveis estão sendo preenchidas corretamente
    $cod_compra = $_SESSION['id'];
    $cod_cliente = $_SESSION['id'];
    $cod_entrega = $_SESSION['id'];
    $valor_entrega = $_SESSION['valor_entrega'];
    $tipo_pagamento = "tipo_pagamento";
    $dia = new DateTime(); 
    $data_compra =  $dia->format('Y-m-d');
    echo $cod_compra . " - " .$cod_cliente . " - " . $cod_entrega . " - " . $valor_entrega . " - " . $tipo_pagamento . " - " . $data_compra;

    $sql = "INSERT INTO tb_compras (cod_compra, cod_cliente, cod_entrega, valor_entrega, tipo_pagamento, data_compra) VALUES(:cp, :c, :e, :v, :p, :d)";

    $stmip = $pdo->prepare($sql);
    $stmip->bindValue(":cp", $cod_compra);
    $stmip->bindValue(":c", $cod_cliente);
    $stmip->bindValue(":e", $cod_entrega);
    $stmip->bindValue(":v", $valor_entrega);
    $stmip->bindValue(":p", $tipo_pagamento);
    $stmip->bindValue(":d", $data_compra);

    if ($stmip->execute()) {
        echo "Venda inserida com sucesso";
    } else {
        echo "Ocorreu um erro ao inserir";
    }

    $valor = $pdo->lastInsertId();

    foreach ($itens as $v) {
        // Aqui você deve ajustar as colunas e valores a serem inseridos na tabela tb_produtos
        // Certifique-se de que as colunas estão corretas e que os valores correspondem.
        $sqlit = "INSERT INTO tb_produtos (cod_produto, ativo, valor, tamanho, descricao) VALUES (:a, :v, :t, :d)";

        $stmit = $pdo->prepare($sqlit);
        $stmit->bindValue(":a", $v['produto']);
        $stmit->bindValue(":v", $v['ativo']);
        $stmit->bindValue(":t", $v['tamanho']);
        $stmit->bindValue(":d", $v['descricao']);

        $stmit->execute();
    }

    // Lembre-se de realizar a limpeza das sessões após a finalização da venda.
    unset($_SESSION['carrinho']);
    unset($_SESSION['valor_entrega']);
}
?>
