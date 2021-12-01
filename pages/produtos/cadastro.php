<?php
    
    if(isset($_POST['cadastrar'])) {
        try{
            $stmt = $conn->prepare("INSERT INTO PRODUTOS (nome, valor, quantidade) 
            VALUES (:nome, :valor, :quantidade)");
            $stmt->bindParam(':nome',       $_POST['nome']);
            $stmt->bindParam(':valor',      $_POST['valor'], PDO::PARAM_STR);
            $stmt->bindParam(':quantidade', $_POST['quantidade'], PDO::PARAM_INT);
            $stmt->execute();
            header('Location: ?page=produtos');
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "Erro ao cadastrar Produto! Confirme as informações e tente novamente.";
        }
    }

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Novo Produto:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=produtos">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
        <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Produto" required/>
            </div>
            <div class="form-group">
                <label for="sigla">Valor:</label>
                <input type="number" class="form-control" name="valor" id="valor" placeholder="Valor" required/>
            </div>
            <div class="form-group">
                <label for="sigla">Quantidade:</label>
                <input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Quantidade"  required/>
            </div>
            <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"/>
        </form>
        
    </div>
</div>