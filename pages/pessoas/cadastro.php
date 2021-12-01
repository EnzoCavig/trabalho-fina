<?php

if (isset($_POST['cadastrar'])) {
    try {
        $stmt = $conn->prepare("INSERT INTO PESSOAS (nome) VALUES (:nome);");
        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->execute();
        header('Location: ?page=pessoas');
    } catch (PDOException $e) {
        echo "Erro ao cadastrar pessoa! Confira as informações e tente novamente.";
    }
}

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Nova Pessoa:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=pessoas">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo" required />
            </div>
            <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar" />
        </form>

    </div>
</div>