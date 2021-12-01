<?php
    
    if(isset($_POST['cadastrar'])) {
        try{
            $stmt = $conn->prepare("INSERT INTO ESTADOS (sigla, nome) VALUES (:sigla, :nome);");
            $stmt->bindParam(':sigla', $_POST['sigla']);
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->execute();
            header('Location: ?page=estados');
        } catch (PDOException $e) {
            echo "Erro ao cadastrar Estado! Confirme as informações e tente novamente.";
        }
    }

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Novo Estado:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=estados">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="sigla">Sigla:</label>
                <input type="text" class="form-control" name="sigla" id="sigla" placeholder="Sigla" maxlength="2" required/>
            </div>
            <div class="form-group">
                <label for="nome">Nome do Estado:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Estado" required/>
            </div>
            <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"/>
        </form>
        
    </div>
</div>