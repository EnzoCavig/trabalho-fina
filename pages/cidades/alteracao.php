<?php
if (isset($_POST['alterar'])) {
    try {
        $stmt = $conn->prepare("UPDATE CIDADES SET codigo= :codigo, nome= :nome, estado= :estado WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->bindParam(':codigo', $_POST['codigo']);
        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->bindParam(':estado', $_POST['estado']);
        $stmt->execute();
        header('Location: ?page=cidades');
    } catch (PDOException $e) {
        echo $e;
        echo "Erro ao alterar informação do Estado! Confirme as informações e tente novamente.";
    }
}

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("select 
                                    c.id,
                                    c.codigo,
                                    c.nome,
                                    e.id as id_estado,
                                    e.nome as nome_estado,
                                    e.sigla as sigla_estado
                                from cidades c
                                join estados e
                                    on e.id = c.estado
                                WHERE c.id = :id;");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll();
} else {
    echo "O ID é necessário para a alteração de um registro!";
}

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Alterar Cidade:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=cidades">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">


            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Código" value="<?= $result[0]['codigo'] ?>" required />
            </div>
            <div class="form-group">
                <label for="nome">Nome da Cidade:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da Cidade" value="<?= $result[0]['nome'] ?>" required />
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" name="estado" id="estado">
                    <?php
                    echo "<option selected value='{$result[0]['id_estado']}'>{$result[0]['nome_estado']} - {$result[0]['sigla_estado']}</option>";
                    $stmt = $conn->prepare("select id, nome, sigla from ESTADOS order by nome asc");
                    $stmt->execute();
                    $resultado = $stmt->fetchAll();
                    if (count($resultado)) {
                        foreach ($resultado as $linha) {
                            echo "<option value='{$linha['id']}'>{$linha['nome']} - {$linha['sigla']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <br />
            <input class="btn btn-success" type="submit" name="alterar" value="Alterar" />
        </form>
    </div>
</div>