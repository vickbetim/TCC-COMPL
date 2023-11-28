<?php
/* carrinho de compra */
session_start();

include_once 'conexao.php';
include_once 'funcaodata.php';

if (isset($_GET['desconectar']) && $_GET['desconectar'] == 1) {
    // Limpa os dados da sessão
    session_start();
    $_SESSION = array();
    session_regenerate_id(); // Regenera o ID da sessão
    session_destroy();
    header("Location: pagina.php"); // Redireciona para a home
    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento
}

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
    <style> body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            background-position:center;
            background-size:cover;
            max-width: 180px;
            max-height: 180px;
            margin-right: 10px;
        }

        input[type="text"] {
            width: 40px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-primary {
            background-color: #28a745;
        }

        .btn-info {
            background-color: #17a2b8;
        }
        </style>
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
                <th width="240"></th>
                <th width="79">Descrição</th>
                <th width="89">Produto&cedil;</th>
                <th width="100">Valor Produto</th>
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
                        $sql = "SELECT * FROM tb_produtos INNER JOIN tb_imagens_produtos ON tb_imagens_produtos.cod_produto = tb_produtos.cod_produto WHERE tb_produtos.cod_produto = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(":id", $id);
                        $stmt->execute();
                        $rp = $stmt->fetch(PDO::FETCH_ASSOC);
            
                        if ($rp) {
                            $produto = $rp['descricao'];
                            $foto = $rp['imagem_produto'];
                            $estoque = isset($rp['estoque']) ? $rp['estoque'] : 0;
                            $valor = isset($rp['valor']) ? number_format($rp['valor'], 2, ',', '.') : 0;
                            $imagem_produto = 'imagens/' . $foto;
                            
                            // Exibe os produtos no carrinho
                            echo '<tr>
                                    <td><img src="' . $imagem_produto. '" width="100px" height="100px"></td>
                                    <td>' . $produto . '</td>
                                    <td><input type="text" size="3" name="prod[' . $id . ']" value="' . $qtd . '" /></td>
                                    <td>R$ ' . $valor . '</td>
                                    <td><a href="?acao=del&id=' . $id . '" class="btn btn-danger">Remover</a></td>
                                </tr>';
            
                            // Calcula o total
                            $total += floatval(str_replace(',', '.', str_replace('.', '', $valor))) * $qtd;
                        } else {
                            echo "Produto não encontrado.";
                        }
                    }
            
                    // Exibe o total fora do loop
                    echo '<tr class="total-row">
                            <td colspan="3">Total</td>
                            <td>R$ ' . number_format($total, 2, ',', '.') . '</td>
                            <td></td> <!-- Coluna extra para ação -->
                        </tr>';
                }
                ?>
            </tbody>
        </form>
    </table>
</body>
</html>
<?php

if (isset($_POST['finalizaVenda'])) {
    // Verifica se o cliente está logado
    // if (!isset($_SESSION['id'])) 
    // Obtém as informações do cliente da sessão
    $cod_cliente = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    $cod_entrega = isset($_SESSION['id']) ? $_SESSION['id']: 01;
    $valor_entrega = isset($_SESSION['valor_entrega']) ? $_SESSION['valor_entrega'] : 25;
    $dia = new DateTime(); 
    $tipo_pagamento = "DINHEIRO";
    $data_compra = $dia->format('d/m/Y');  

    
    $dia = new DateTime();
    $data_compra = $dia->format('Y-m-d'); 
    // <td><?php echo date('d/m/Y', strtotime($r['nasc_cliente'])); 
    

    // Insere os dados da compra na tabela 'tb_compras'
    $sql = "INSERT INTO tb_compras (cod_cliente, cod_entrega, valor_entrega, tipo_pagamento, data_compra)
            VALUES (:cod_cliente, :cod_entrega, :valor_entrega, :tipo_pagamento, :data_compra)";

    $stmip = $pdo->prepare($sql);
    $stmip->bindValue(":cod_cliente", $_SESSION['cod_cliente']);
    $stmip->bindValue(":cod_entrega", $cod_entrega);
    $stmip->bindValue(":valor_entrega", $valor_entrega);
    $stmip->bindValue(":tipo_pagamento", $tipo_pagamento);
    $stmip->bindValue(":data_compra", $data_compra);

    if ($stmip->execute()) {
        // Sucesso ao inserir a compra
        $cod_compra = $pdo->lastInsertId();  // Obtém o ID da compra recém-inserida

        // Agora, você pode processar os itens do carrinho e associá-los à compra
        foreach ($_SESSION['carrinho'] as $id_produto => $qtd) {
            // Obtém informações do produto
            $sqlProduto = "SELECT * FROM tb_produtos WHERE cod_produto = :cod_produto";
            $stmtProduto = $pdo->prepare($sqlProduto);
            $stmtProduto->bindValue(":cod_produto", $id_produto);
            $stmtProduto->execute();
            $produto = $stmtProduto->fetch(PDO::FETCH_ASSOC);

            if ($produto) {
                // Insere os detalhes da compra na tabela 'tb_compras_produtos'
                $sqlDetalhes = "INSERT INTO tb_compras_produtos (cod_compra, cod_produto, quantidade, valor)
                                VALUES (:cod_compra, :cod_produto, :quantidade, :valor)";

                $stmDetalhes = $pdo->prepare($sqlDetalhes);
                $stmDetalhes->bindValue(":cod_compra", $cod_compra);
                $stmDetalhes->bindValue(":cod_produto", $id_produto);
                $stmDetalhes->bindValue(":quantidade", $qtd);
                $stmDetalhes->bindValue(":valor", $produto['valor']);
                

                $stmDetalhes->execute();
            }
        }

        // Limpeza do carrinho e outros dados de sessão após a compra
        unset($_SESSION['carrinho']);
        unset($_SESSION['valor_entrega']);
        {
        
         echo "Compra realizada com sucesso. ID da compra: $cod_compra";
         echo '<br><a href="pagina.php?desconectar=1">Voltar para a Home</a>';


// echo '<script>alert("Compra realizada com sucesso. ID da compra: ' . $cod_compra . '");</script>';
// echo '<script>window.location.href = "pagina.php";</script>';

           }

    
    } 
}
?>

            </tbody>
        </form>
    </table>
</body>

</html>