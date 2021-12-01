<?php
    
    if(isset($_POST['alterar'])) {
        try{
            $stmt = $conn->prepare("UPDATE PRODUTOS SET nome = :nome, valor = :valor, quantidade = :quantidade WHERE ID = :id");
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->bindParam(':valor', $_POST['valor'], PDO::PARAM_STR);
            $stmt->bindParam(':quantidade', $_POST['quantidade'], PDO::PARAM_INT);
            $stmt->execute();
            header('Location: ?page=produtos');
        } catch (PDOException $e) {
            echo $e;
            echo "Erro ao alterar informação do Produto! Confirme as informações e tente novamente.";
        }
    }

    if(isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = :id;");
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
                <h2>Alterar Produto:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=produtos">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Produto" value="<?=$result[0]['nome']?>" required/>
            </div>
            <div class="form-group">
                <label for="sigla">Valor:</label>
                <input type="number" class="form-control" name="valor" id="valor" placeholder="Valor"  value="<?=$result[0]['valor']?>" required/>
            </div>
            <div class="form-group">
                <label for="sigla">Quantidade:</label>
                <input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Quantidade" value="<?=$result[0]['quantidade']?>" required/>
            </div>
            <input class="btn btn-success" type="submit" name="alterar" value="Alterar"/>
        </form>
        
    </div>
</div>