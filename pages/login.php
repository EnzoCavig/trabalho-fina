<!DOCTYPE HTML>
<html lang="pt-br">
     <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php
            
            if(isset($_POST['logar'])) {
                $stmt = $conn->prepare('SELECT login FROM USUARIOS WHERE login = :login AND password = md5(:password)');
                $stmt->bindParam(':login', $_POST['login']);
                $stmt->bindParam(':password', $_POST['password']);
                $stmt->execute();
                $result = $stmt->fetchAll();

                if($_POST['login'] == $result[0]['login']) {
                    $_SESSION['usuariologado'] = true;
                    header('Location: ./');
                } else {
                    $_SESSION['errologin'] = true;
                }
            }

            if(isset($_POST['errologin']) && $_SESSION['errologin']){
                $_SESSION['errologin'] = false;
                echo "<b> Erro na Autenticação, Usuário ou Senha inválido! </b>";
            }

        ?>


        <div class="container">
            <div class="col-md">
                <div class="row">
                    <div class="col-6">
                        <h2>Login:</h2>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-info float-right" href="?action=cadastrar">Cadastrar-se</a>
                    </div>
                </div>
                <hr />
                <form method="POST">
                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Login" />
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha" />
                    </div>
                    <input class="btn btn-success" type="submit" name="logar" value="Logar"/>
                </form>
                
            </div>
        </div>
    </body>
</html>