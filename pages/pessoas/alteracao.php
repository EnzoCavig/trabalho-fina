<?php

if (isset($_POST['alterar'])) {
    try {
        $stmt = $conn->prepare("UPDATE PESSOAS SET nome = :nome WHERE ID = :id;");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->execute();
        header('Location: ?page=pessoas');
    } catch (PDOException $e) {
        echo $e;
        echo "Erro ao alterar informação da Pessoa! Confirme as informações e tente novamente.";
    }
}

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM PESSOAS WHERE ID = :id;");
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
                <h2>Alterar Pessoa:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-success float-right" href="?page=pessoas">Listagem de Pessoas</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo" value="<?= $result[0]['nome'] ?>" />
            </div>
            <input class="btn btn-success" type="submit" name="alterar" value="Alterar" />
        </form>
    </div>
</div>