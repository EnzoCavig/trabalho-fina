<?php
    
    if(isset($_POST['alterar'])) {
        try{
            $stmt = $conn->prepare("UPDATE ESTADOS SET sigla = :sigla, nome = :nome WHERE ID = :id;");
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->bindParam(':sigla', $_POST['sigla']);
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->execute();
            header('Location: ?page=estados');
        } catch (PDOException $e) {
            echo $e;
            echo "Erro ao alterar informação do Estado! Confirme as informações e tente novamente.";
        }
    }

    if(isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT * FROM estados WHERE id = :id;");
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
                <h2>Alterar Estado:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=estados">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="sigla">Sigla:</label>
                <input type="text" class="form-control" name="sigla" id="sigla" placeholder="Sigla" maxlength="2" value="<?=$result[0]['sigla']?>" required/>
            </div>
            <div class="form-group">
                <label for="nome">Nome do Estado:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Estado" value="<?=$result[0]['nome']?>" required/>
            </div>
            <input class="btn btn-success" type="submit" name="alterar" value="Alterar"/>
        </form>
        
    </div>
</div>