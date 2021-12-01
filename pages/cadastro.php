<!DOCTYPE HTML>
<html lang="pt-br">
     <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Cadastre-se</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php
            
            if(isset($_POST['cadastrar'])) {
                try{
                    $stmt = $conn->prepare("INSERT INTO USUARIOS (login, email, nome, password) VALUES (:login, :email, :nome, md5(:password));");
                    $stmt->bindParam(':login', $_POST['login']);
                    $stmt->bindParam(':email', $_POST['email']);
                    $stmt->bindParam(':nome', $_POST['nome']);
                    $stmt->bindParam(':password', $_POST['password']);
                    $stmt->execute();
                    header('Location: ./');
                } catch (PDOException $e) {
                    echo "Erro: {$e->getMessage()}";
                }
            }

        ?>


        <div class="container">
            <div class="col-md">
                <div class="row">
                    <div class="col-6">
                        <h2>Novo Usuário:</h2>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-info float-right" href="?action=login">Retornar</a>
                    </div>
                </div>
                <hr />
                <form method="POST">
                    <div class="form-group">
                        <label for="login">Nome de Usuário:</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Nome de Usuário" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email@mail.com" />
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo" />
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha" />
                    </div>
                    <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"/>
                </form>
                
            </div>
        </div>
    </body>
</html>