<?php

if (isset($_POST['cadastrar'])) {
    try {
        $stmt = $conn->prepare("INSERT INTO CIDADES (codigo, nome, estado) VALUES (:codigo, :nome, :estado);");
        $stmt->bindParam(':codigo', $_POST['codigo']);
        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->bindParam(':estado', $_POST['estado']);
        $stmt->execute();
        header('Location: ?page=cidades');
    } catch (PDOException $e) {
        echo "Erro ao cadastrar Cidade! Confirme as informações e tente novamente.";
    }
}

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Nova Cidade:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=cidades">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Código" required />
            </div>
            <div class="form-group">
                <label for="nome">Nome da Cidade:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da Cidade" required />
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" name="estado" id="estado">
                    <?php
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
            <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar" />
        </form>
    </div>
</div>